<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use App\Http\Requests\InstallDatabaseRequest;
use App\Http\Requests\InstallUserRequest;
use App\Services\EnvService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class InstallController extends Controller
{
    public function __construct()
    {
        $this->middleware('install')->except(['finish']);
    }

    public function index()
    {
        $locale = Session::get('locale', env('APP_LOCALE'));
        App::setLocale($locale);
        $locales = EnvService::getEnvLocale();
        Artisan::call('key:generate', ['--force' => true]);
        Artisan::call('storage:link', ['--force' => true]);
        Artisan::call('optimize:clear');
        return view('install.index', compact('locale', 'locales'));
    }

    public function settings($locale)
    {
        App::setLocale($locale);
        return view('install.settings', compact('locale'));
    }

    public function check(InstallDatabaseRequest $request, $locale)
    {
        App::setLocale($locale);
        $request->validated();
        try {
            $dsn = sprintf('mysql:host=%s;port=%s;dbname=%s', $request->input('database.host'), $request->input('database.port'), $request->input('database.name'));
            new \PDO($dsn, $request->input('database.username'), $request->input('database.password'));
            EnvService::updateEnv('APP_NAME', $request->input('website.name'));
            EnvService::updateEnv('APP_URL', $request->input('website.address'));
            EnvService::updateEnv('APP_LOCALE', $locale);
            EnvService::updateEnv('DB_HOST', $request->input('database.host'));
            EnvService::updateEnv('DB_PORT', $request->input('database.port'));
            EnvService::updateEnv('DB_DATABASE', $request->input('database.name'));
            EnvService::updateEnv('DB_USERNAME', $request->input('database.username'));
            EnvService::updateEnv('DB_PASSWORD', $request->input('database.password'));
            return redirect()->route('install.create', ['locale' => $locale]);
        } catch (\PDOException $e) {
            throw ValidationException::withMessages([
                'database.host' => trans('The database connection failed, please check that the database is configured correctly.'),
            ]);
        }
    }

    public function create($locale)
    {
        App::setLocale($locale);
        if (env('APP_NAME') && env('APP_URL') && env('DB_HOST') && env('DB_PORT') && env('DB_DATABASE') && env('DB_USERNAME') && env('DB_PASSWORD')) {
            try {
                $dsn = sprintf('mysql:host=%s;port=%s;dbname=%s', env('DB_HOST'), env('DB_PORT'), env('DB_DATABASE'));
                new \PDO($dsn, env('DB_USERNAME'), env('DB_PASSWORD'));
                return view('install.create', compact('locale'));
            } catch (\PDOException $e) {
                return redirect()->route('install.index');
            }
        } else {
            return redirect()->route('install.index')->with('locale', $locale);
        }
    }

    public function install(InstallUserRequest $request, $locale)
    {
        App::setLocale($locale);
        $request->validated();
        if (env('APP_NAME') && env('APP_URL') && env('DB_HOST') && env('DB_PORT') && env('DB_DATABASE') && env('DB_USERNAME') && env('DB_PASSWORD')) {
            try {
                $dsn = sprintf('mysql:host=%s;port=%s;dbname=%s', env('DB_HOST'), env('DB_PORT'), env('DB_DATABASE'));
                new \PDO($dsn, env('DB_USERNAME'), env('DB_PASSWORD'));
                EnvService::updateEnv('WEBMASTER_NAME', $request->input('name'));
                EnvService::updateEnv('WEBMASTER_EMAIL', $request->input('email'));
                Artisan::call('migrate:fresh', ['--force' => true]);
                \App\Models\User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'email_verified_at' => now(),
                ]);
                \App\Models\Category::create([
                    'title' => trans('install.first_category_name'),
                    'slug' => trans('install.first_category_slug'),
                    'parent_id' => null,
                    'description' => trans('install.first_category_description')
                ]);
                $firstUlid = Str::ulid();
                \App\Models\Post::create([
                    'ulid' => $firstUlid,
                    'title' => trans('install.first_article_title'),
                    'slug' => trans('install.first_article_slug'),
                    'content' => trans('install.first_article_content'),
                    'image' => '/storage/images/660200782b63f73c4ae3fa42773deeea.jpg',
                    'background_image' => 1,
                    'published' => 1,
                    'user_id' => 1,
                    'category_id' => 1,
                    'views' => 0,
                    'meta_description' => trans('install.first_article_description'),
                    'meta_keywords' => env('APP_KEYWORDS'),
                    'published_at' => date('Y-m-d H:i:s', strtotime('-10 minute'))
                ]);
                \App\Models\Post::create([
                    'ulid' => Str::ulid(),
                    'title' => trans('install.second_article_title'),
                    'slug' => trans('install.second_article_slug'),
                    'content' => trans('install.second_article_content'),
                    'image' => '',
                    'background_image' => 0,
                    'published' => 1,
                    'user_id' => 1,
                    'category_id' => 1,
                    'views' => 0,
                    'meta_description' => trans('install.second_article_description'),
                    'meta_keywords' => env('APP_KEYWORDS'),
                    'published_at' => date('Y-m-d H:i:s', strtotime('-5 minute'))
                ]);
                \App\Models\Post::create([
                    'ulid' => Str::ulid(),
                    'title' => trans('install.third_article_title'),
                    'slug' => trans('install.third_article_slug'),
                    'content' => trans('install.third_article_content'),
                    'image' => '/storage/images/660200782b63f73c4ae3fa42773deeea.jpg',
                    'background_image' => 0,
                    'published' => 1,
                    'user_id' => 1,
                    'category_id' => 1,
                    'views' => 0,
                    'meta_description' => trans('install.third_article_description'),
                    'meta_keywords' => env('APP_KEYWORDS'),
                    'published_at' => date('Y-m-d H:i:s')
                ]);
                \App\Models\Comment::create([
                    'post_id' => $firstUlid,
                    'user_id' => 1,
                    'parent_id' => null,
                    'content' => trans('install.first_comment_content'),
                ]);
                \App\Models\Tag::create([
                    'name' => 'DustinkY',
                    'user_id' => 1,
                ]);
                \App\Models\PostsTag::create([
                    'post_id' => $firstUlid,
                    'tag_id' => 1,
                ]);
                \App\Models\Statistic::create([
                    'total_uv' => 1,
                ]);
                file_put_contents(base_path('install.lock'), 'this system is installed at ' . date('Y-m-d H:i:s'));
                return redirect()->route('install.finish', ['locale' => $locale]);
            } catch (\PDOException $e) {
                return redirect()->route('install.index')->with('locale', $locale);
            }
        }
    }

    public function finish($locale)
    {
        App::setLocale($locale);
        if (env('APP_NAME') && env('APP_URL') && env('DB_HOST') && env('DB_PORT') && env('DB_DATABASE') && env('DB_USERNAME') && env('DB_PASSWORD') && is_file(base_path('install.lock'))) {
            return view('install.finish');
        } else {
            return redirect()->route('install.index');
        }
    }
}
