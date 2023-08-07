<?php
namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\Provider;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Overtrue\Socialite\SocialiteManager;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rules;

class AuthController extends Controller
{
    /**
     * Show the application's login form.
     */
    public function redirectToProvider($driver)
    {
        $socialite = new SocialiteManager(config('services'));
        $url = $socialite->create($driver)->redirect();
        return redirect($url);
    }

    /**
     * Obtain the user information from the provider.
     */
    public function handleProviderCallback($driver)
    {
        $socialite = new SocialiteManager(config('services'));
        $code = request()->query('code');
        $user = $socialite->create($driver)->userFromCode($code);

        // 在 providers 表中查找 provider_id
        $userProvider = Provider::where('provider', $driver)
            ->where('provider_id', $user->getId())
            ->first();

        if ($userProvider) {
            // 用户在 providers 表中找到，获取对应用户信息
            $existingUser = User::find($userProvider->user_id);

            // 执行登录操作
            Auth::login($existingUser);
            return redirect(RouteServiceProvider::HOME);
        } else {
            // 用户不存在，跳转到绑定账号或注册账号页面
            session([
                'provider' => $driver,
                'provider_id' => $user->getId(),
                'name' => $user->getName(),
                'email' => $user->getEmail(),
            ], 10);
            return redirect('/bind-or-register');
        }
    }

    /**
     * Show the application's login form.
     */
    public function showBindOrRegisterPage()
    {
        // 获取从第三方登录回调页面传递过来的信息
        $provider = session('provider');
        $provider_id = session('provider_id');
        if (!$provider || !$provider_id) {
            return redirect(route('login'));
        }

        $user = [
            'provider' => $provider,
            'provider_id' => $provider_id,
            'name' => session('name'),
            'email' => session('email'),
        ];

        $button_text = trans('auth.bind_reg', [ 'provider' => $provider ]);

        return view('auth.bind-or-register', compact('user','button_text'));
    }

    /**
     * Bind or register the user.
     */
    public function bindOrRegister(Request $request)
    {
        $provider = request('provider');
        $provider_id = request('provider_id');
        $userProvider = Provider::where('provider', $provider)
            ->where('provider_id', $provider_id)
            ->first();
        if ($userProvider) {
            $existingUser = User::find($userProvider->user_id);
            Auth::login($existingUser);
            return redirect(RouteServiceProvider::HOME);
        } else {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);
            $newUser = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            Provider::create([
                'user_id' => $newUser->id,
                'provider' => $provider,
                'provider_id' => $provider_id,
            ]);
            event(new Registered($newUser));
            Auth::login($newUser);
            return redirect(RouteServiceProvider::HOME);
        }
    }

    public function showBindAccountPage()
    {
        $provider = session('provider');
        $provider_id = session('provider_id');
        if (!$provider || !$provider_id) {
            return redirect(route('login'));
        }

        $user = [
            'provider' => $provider,
            'provider_id' => $provider_id,
        ];
        $button_text = trans('auth.bind_account', [ 'provider' => $provider ]);
        return view('auth.bind-account', compact('user','button_text'));
    }

    public function bindAccount(LoginRequest $request)
    {
        $provider = request('provider');
        $provider_id = request('provider_id');

        if (empty($provider) || empty($provider_id)) {
            return redirect(route('login'));
        }else {
            $request->authenticate();
            $request->session()->regenerate();
            $user = $request->user();
            Provider::create([
                'user_id' => $user->id,
                'provider' => $provider,
                'provider_id' => $provider_id,
            ]);
            return redirect(RouteServiceProvider::HOME);
        }
    }
}
