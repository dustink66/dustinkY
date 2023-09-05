<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('splade')->group(function () {
    Route::spladeWithVueBridge();
    Route::spladePasswordConfirmation();
    Route::spladeTable();
    Route::spladeUploads();

    Route::middleware(['auth', 'master', 'verified'])->group(function () {
        Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard.index');
        Route::patch('/dashboard', 'App\Http\Controllers\DashboardController@update')->name('dashboard.update');
        Route::get('/dashboard/setting', 'App\Http\Controllers\DashboardController@setting')->name('dashboard.setting');
        Route::get('/dashboard/storage', 'App\Http\Controllers\DashboardController@storage')->name('dashboard.storage');
        Route::get('/dashboard/socialite', 'App\Http\Controllers\DashboardController@socialite')->name('dashboard.socialite');
        Route::get('/dashboard/master', 'App\Http\Controllers\DashboardController@master')->name('dashboard.master');
        Route::get('/dashboard/mail', 'App\Http\Controllers\DashboardController@mail')->name('dashboard.mail');
        Route::get('/dashboard/secure', 'App\Http\Controllers\DashboardController@secure')->name('dashboard.secure');
        Route::get('/dashboard/scout', 'App\Http\Controllers\DashboardController@scout')->name('dashboard.scout');
        Route::get('/dashboard/background/image', 'App\Http\Controllers\DashboardController@bgImage')->name('dashboard.background.image');
        Route::get('/dashboard/background/video', 'App\Http\Controllers\DashboardController@bgVideo')->name('dashboard.background.video');

        Route::resource('posts', \App\Http\Controllers\PostController::class)->except(['show']);
        Route::resource('categories', \App\Http\Controllers\CategoryController::class)->except(['show']);
        Route::get('/tags', 'App\Http\Controllers\TagController@index')->name('tags.index');
        Route::get('/tags/search', 'App\Http\Controllers\TagController@search')->name('tags.search');
        Route::post('/tags', 'App\Http\Controllers\TagController@store')->name('tags.store');
        Route::post('/posts/{post}/tags', 'App\Http\Controllers\TagController@createPostsTag')->name('posts.tags.store');
        Route::get('/posts/{post}/tags', 'App\Http\Controllers\TagController@getPostsTag')->name('posts.tags.index');
        Route::delete('/posts/{post}/tags', 'App\Http\Controllers\TagController@destroyPostsTag')->name('posts.tags.destroy');
        Route::resource('users', \App\Http\Controllers\UserController::class);
        Route::resource('comments', \App\Http\Controllers\CommentController::class)->except(['store']);
        Route::get('/posts/{post}/comments', 'App\Http\Controllers\PostController@comment')->name('posts.comments');
    });

    Route::middleware('uvcount')->group(function () {
        Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');
        Route::get('/tag/{name?}', 'App\Http\Controllers\HomeController@tag')->name('tag');
        Route::get('/timeline/{yearMonth?}', 'App\Http\Controllers\HomeController@timeline')
            ->where('yearMonth', '(20\d{2}(0[1-9]|1[0-2])|\d{4}(0?[1-9]|1[0-2]))')
            ->name('timeline');
        Route::get('/getPostsByDate/{date}', 'App\Http\Controllers\HomeController@getPostsByDate')->name('getPostsByDate');
        Route::get('/posts/{post:slug}', 'App\Http\Controllers\PostController@show')->name('posts.show');
        Route::get('/categories/{category:slug}', 'App\Http\Controllers\CategoryController@show')->name('categories.show');
        Route::get('/search', 'App\Http\Controllers\HomeController@search')->name('search');
        Route::post('/search', 'App\Http\Controllers\HomeController@searchResult')->name('search.result');
        Route::get('/comments/post/{post:ulid}', 'App\Http\Controllers\CommentController@post')->name('comments.post');
        Route::get('/is_login', function () {
            if (auth()->check()) {
                return response()->json(['code' => 200, 'data' => auth()->user()]);
            } else {
                return response()->json(['code' => 401, 'message' => 'Unauthorized.']);
            }
        });
    });

    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        Route::post('/comments', 'App\Http\Controllers\CommentController@store')->name('comments.store');
        Route::post('/upload/video', 'App\Http\Controllers\UploadController@video')->name('upload.video');
        Route::post('/upload/image', 'App\Http\Controllers\UploadController@image')->name('upload.image');
        Route::post('/upload/file', 'App\Http\Controllers\UploadController@file')->name('upload.file');
        Route::post('/upload/check_exists', 'App\Http\Controllers\UploadController@checkExists')->name('upload.check_exists');
    });

    Route::get('/install', 'App\Http\Controllers\InstallController@index')->name('install.index');
    Route::get('/install/settings/{locale}', 'App\Http\Controllers\InstallController@settings')->name('install.settings');
    Route::post('/install/check/{locale}', 'App\Http\Controllers\InstallController@check')->name('install.check');
    Route::get('/install/create/{locale}', 'App\Http\Controllers\InstallController@create')->name('install.create');
    Route::post('/install/install/{locale}', 'App\Http\Controllers\InstallController@install')->name('install.install');
    Route::get('/install/finish/{locale}', 'App\Http\Controllers\InstallController@finish')->name('install.finish');
    Route::get('/select-locale/{locale}', function ($locale) {
        \Illuminate\Support\Facades\Session::put('locale', $locale);
        return redirect()->back();
    })->name('select-locale');

    require __DIR__.'/auth.php';
});
