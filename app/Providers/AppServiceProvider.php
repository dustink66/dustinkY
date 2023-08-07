<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $backgroundImageArray = json_decode(env('BACKGROUND_IMAGE'), true);
        $backgroundVideoArray = json_decode(env('BACKGROUND_VIDEO'), true);
        foreach ($backgroundImageArray as $key => $backgroundImage) {
            $backgroundImageArray[$key]['type'] = 'image';
        }
        foreach ($backgroundVideoArray as $key => $backgroundVideo) {
            $backgroundVideoArray[$key]['type'] = 'video';
        }
        if (empty($backgroundImageArray) && empty($backgroundVideoArray)) {
            $selectedItem = [
                'url' => '/storage/images/660200782b63f73c4ae3fa42773deeea.jpg',
                'type' => 'image',
            ];
        } elseif (empty($backgroundImageArray)) {
            $selectedItem = $backgroundVideoArray[array_rand($backgroundVideoArray)];

        } elseif (empty($backgroundVideoArray)) {
            $selectedItem = $backgroundImageArray[array_rand($backgroundImageArray)];
        } else {
            $selectedItem = array_merge($backgroundImageArray, $backgroundVideoArray)[array_rand(array_merge($backgroundImageArray, $backgroundVideoArray))];
        }
        $selectedItemUrl = $selectedItem['url'];
        $selectedItemType = $selectedItem['type'];
        \Illuminate\Support\Facades\View::share('BACKGROUND_IMAGE', $selectedItemUrl);
        \Illuminate\Support\Facades\View::share('BACKGROUND_TYPE', $selectedItemType);
        \Illuminate\Support\Facades\View::share('FONT_FAMILY', env('APP_FONT_FAMILY'));
    }
}
