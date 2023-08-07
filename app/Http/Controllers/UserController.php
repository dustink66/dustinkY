<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Tables\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\FormBuilder\Input;
use ProtoneMedia\Splade\FormBuilder\Password;
use ProtoneMedia\Splade\FormBuilder\Submit;
use ProtoneMedia\Splade\SpladeForm;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index', [
            'users' => Users::class,
        ]);
    }

    public function create()
    {
        $form = SpladeForm::make()
            ->action(route('users.store'))
            ->fields([
                Input::make('name')->label('Name')->rules('required', 'max:255'),
                Input::make('email')->label('Email Address')->rules('required', 'email', 'max:255', 'unique:users'),
                Password::make('password')->label('User Password')->rules('required', 'min:8'),
                Submit::make()->label('Create User')->class('w-full'),
            ])
            ->class('space-y-4');

        return view('users.create', [
            'form' => $form,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', Rules\Password::defaults()],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Toast::success(trans('User created!'))->autoDismiss(5);

        return redirect()->route('users.index');
    }

    public function show(User $user)
    {
    }

    public function edit(User $user)
    {
        $form = SpladeForm::make()
            ->action(route('users.update', $user))
            ->method('PUT')
            ->fields([
                Input::make('name')->label('Name')->rules('required', 'max:255'),
                Input::make('email')->label('Email Address')->rules(['required', 'string', 'email', 'max:255', 'unique:' . User::class . ',id,' . $user->id]),
                Password::make('password')->label('User Password')->rules('nullable', 'min:8'),
                Submit::make()->label('Edit User')->class('w-full'),
            ])
            ->fill($user)
            ->class('space-y-4');

        return view('users.edit', [
            'form' => $form,
        ]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class . ',id,' . $user->id],
            'password' => ['nullable', Rules\Password::defaults()],
        ]);

        if ( User::find($user->id)->email !== $request->email ) {
            $request->validate([
                'email' => ['unique:' . User::class],
            ]);
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        Toast::success(trans('User updated!'))->autoDismiss(5);

        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        if ($user->id === 1) {
            Toast::danger(trans('You cannot delete the first user!'))->autoDismiss(5);
            return redirect()->route('users.index');
        }
        $user->delete();
        Toast::success(trans('User deleted!'))->autoDismiss(5);
        return redirect()->route('users.index');
    }
}
