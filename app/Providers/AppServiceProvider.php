<?php

namespace App\Providers;

use App\Services\EnvService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use ProtoneMedia\Splade\Facades\SEO;

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
        SEO::openGraphType('website');
        SEO::openGraphSiteName(config('app.name'));
        SEO::openGraphUrl(config('app.url'));
        SEO::openGraphTitle(config('app.name'));
        SEO::metaByProperty('og:description', EnvService::getEnv('APP_DESCRIPTION'));
        $backgroundImageArray = json_decode(env('BACKGROUND_IMAGE'), true);
        if (!empty($backgroundImageArray)) {
            $randomKey = array_rand($backgroundImageArray);
            $selectedImage = $backgroundImageArray[$randomKey];
            SEO::openGraphImage($selectedImage['url']);
        } else {
            SEO::openGraphImage(config('app.url').'/storage/images/660200782b63f73c4ae3fa42773deeea.jpg',);
        }
        $backgroundVideoArray = json_decode(env('BACKGROUND_VIDEO'), true);
        if (empty($backgroundImageArray) || empty($backgroundVideoArray)) {
            // Handle error if BACKGROUND_IMAGE or BACKGROUND_VIDEO is not defined
            $selectedItem = [
                'url' => '/storage/images/660200782b63f73c4ae3fa42773deeea.jpg',
                'type' => 'image',
            ];
        } else {
            // Add type to each item in the arrays
            foreach ($backgroundImageArray as $key => $backgroundImage) {
                $backgroundImageArray[$key]['type'] = 'image';
            }
            foreach ($backgroundVideoArray as $key => $backgroundVideo) {
                $backgroundVideoArray[$key]['type'] = 'video';
            }

            // Merge the arrays and randomly select an item
            $mergedArray = array_merge($backgroundImageArray, $backgroundVideoArray);
            $selectedItem = $mergedArray[array_rand($mergedArray)];
        }

        $selectedItemUrl = $selectedItem['url'];
        $selectedItemType = $selectedItem['type'];
        \Illuminate\Support\Facades\View::share('BACKGROUND_IMAGE', $selectedItemUrl);
        \Illuminate\Support\Facades\View::share('BACKGROUND_TYPE', $selectedItemType);
        \Illuminate\Support\Facades\View::share('FONT_FAMILY', env('APP_FONT_FAMILY'));
    }
}
