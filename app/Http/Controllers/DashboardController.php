<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use App\Services\EnvService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $operating_environment = [
            'phpVersion' => PHP_VERSION,
            'laravelVersion' => app()->version(),
            'serverOs' => PHP_OS,
            'serverSoftware' => $_SERVER['SERVER_SOFTWARE'],
            'databaseConnectionName' => config('database.default'),
            'databaseVersion' => \DB::select('select version() as version')[0]->version,
        ];
        $site_info = [
            'name' => config('app.name'),
            'url' => config('app.url'),
            'timezone' => config('app.timezone'),
            'locale' => config('app.locale'),
            'route' => base_path(),
        ];
        $dustinkY = config('dustinkY');
        $overview = [
            'postCount' => Post::count(),
            'userCount' => User::count(),
            'commentCount' => Comment::count(),
            'categoryCount' => Category::count(),
            'tagCount' => Tag::count(),
        ];
        return view('dashboard.index', compact('operating_environment', 'dustinkY', 'site_info', 'overview'));
    }

    public function update(Request $request)
    {
        $attributeNames = $request->keys();
        $error = [];
        foreach ($attributeNames as $key => $attributeName) {
            if(EnvService::updateEnv($attributeName, $request->input($attributeName))) {
                continue;
            } else {
                array_push($error, $attributeName);
            }
        }
        if (count($error) > 0) {
            return response()->json(['message' => trans('Update Failure')], 500);
        } else {
            return response()->json(['message' => trans('Update Success')], 200);
        }
    }

    public function setting()
    {
        $APP_SWITCH = EnvService::getEnv('APP_SWITCH');
        $APP_NAME = EnvService::getEnv('APP_NAME');
        $APP_URL = EnvService::getEnv('APP_URL');
        $APP_LOGO = EnvService::getEnv('APP_LOGO');
        $APP_SWITCH_MESSAGE = EnvService::getEnv('APP_SWITCH_MESSAGE');
        $APP_KEYWORDS = EnvService::getEnv('APP_KEYWORDS');
        $APP_DESCRIPTION = EnvService::getEnv('APP_DESCRIPTION');
        $ICP_NUMBER = EnvService::getEnv('ICP_NUMBER');
        $APP_TIMEZONE = EnvService::getEnv('APP_TIMEZONE');
        $APP_TIMEZONES = EnvService::getEnvTimezone();
        $APP_LOCALE = EnvService::getEnv('APP_LOCALE');
        $APP_LOCALES = EnvService::getEnvLocale();
        $APP_FONT_FAMILY = EnvService::getEnv('APP_FONT_FAMILY');
        return view('dashboard.setting', compact('APP_SWITCH','APP_NAME', 'APP_URL', 'APP_LOGO', 'APP_SWITCH_MESSAGE', 'APP_KEYWORDS', 'APP_DESCRIPTION', 'ICP_NUMBER', 'APP_TIMEZONE', 'APP_TIMEZONES', 'APP_LOCALE', 'APP_LOCALES', 'APP_FONT_FAMILY'));
    }

    public function storage()
    {
        $FILESYSTEM_DISK = EnvService::getEnv('FILESYSTEM_DISK');
        $FILESYSTEM_DISKS = EnvService::getEnvDisks();
        $QINIU_ACCESS_KEY = EnvService::getEnv('QINIU_ACCESS_KEY');
        $QINIU_SECRET_KEY = EnvService::getEnv('QINIU_SECRET_KEY');
        $QINIU_BUCKET = EnvService::getEnv('QINIU_BUCKET');
        $QINIU_DOMAIN = EnvService::getEnv('QINIU_DOMAIN');
        return view('dashboard.storage', compact('FILESYSTEM_DISK', 'FILESYSTEM_DISKS', 'QINIU_ACCESS_KEY', 'QINIU_SECRET_KEY', 'QINIU_BUCKET', 'QINIU_DOMAIN'));
    }

    public function socialite()
    {
        $SOCIALITE_ENABLED = EnvService::getEnv('SOCIALITE_ENABLED');
        $GITHUB_CLIENT_ID = EnvService::getEnv('GITHUB_CLIENT_ID');
        $GITHUB_CLIENT_SECRET = EnvService::getEnv('GITHUB_CLIENT_SECRET');
        $QQ_CLIENT_ID = EnvService::getEnv('QQ_CLIENT_ID');
        $QQ_CLIENT_SECRET = EnvService::getEnv('QQ_CLIENT_SECRET');
        $GITEE_CLIENT_ID = EnvService::getEnv('GITEE_CLIENT_ID');
        $GITEE_CLIENT_SECRET = EnvService::getEnv('GITEE_CLIENT_SECRET');
        $OUTLOOK_CLIENT_ID = EnvService::getEnv('OUTLOOK_CLIENT_ID');
        $OUTLOOK_CLIENT_SECRET = EnvService::getEnv('OUTLOOK_CLIENT_SECRET');
        $WEIBO_CLIENT_ID = EnvService::getEnv('WEIBO_CLIENT_ID');
        $WEIBO_CLIENT_SECRET = EnvService::getEnv('WEIBO_CLIENT_SECRET');
        return view('dashboard.socialite', compact('SOCIALITE_ENABLED', 'GITHUB_CLIENT_ID', 'GITHUB_CLIENT_SECRET', 'QQ_CLIENT_ID', 'QQ_CLIENT_SECRET', 'GITEE_CLIENT_ID', 'GITEE_CLIENT_SECRET', 'OUTLOOK_CLIENT_ID', 'OUTLOOK_CLIENT_SECRET', 'WEIBO_CLIENT_ID', 'WEIBO_CLIENT_SECRET'));
    }

    public function master()
    {
        $WEBMASTER_NAME = EnvService::getEnv('WEBMASTER_NAME');
        $WEBMASTER_EMAIL = EnvService::getEnv('WEBMASTER_EMAIL');
        $WEBMASTER_AVATAR = EnvService::getEnv('WEBMASTER_AVATAR');
        return view('dashboard.master', compact('WEBMASTER_NAME', 'WEBMASTER_EMAIL', 'WEBMASTER_AVATAR'));
    }

    public function mail()
    {
        $MAIL_MAILER = EnvService::getEnv('MAIL_MAILER');
        $MAIL_MAILERS = EnvService::getEnvMailers();
        $MAIL_HOST = EnvService::getEnv('MAIL_HOST');
        $MAIL_PORT = EnvService::getEnv('MAIL_PORT');
        $MAIL_USERNAME = EnvService::getEnv('MAIL_USERNAME');
        $MAIL_PASSWORD = EnvService::getEnv('MAIL_PASSWORD');
        $MAIL_ENCRYPTION = EnvService::getEnv('MAIL_ENCRYPTION');
        $MAIL_ENCRYPTIONS = EnvService::getEnvMailEncryption();
        $MAIL_FROM_ADDRESS = EnvService::getEnv('MAIL_FROM_ADDRESS');
        $MAIL_FROM_NAME = EnvService::getEnv('MAIL_FROM_NAME');
        return view('dashboard.mail', compact('MAIL_MAILER', 'MAIL_MAILERS', 'MAIL_HOST', 'MAIL_PORT', 'MAIL_USERNAME', 'MAIL_PASSWORD', 'MAIL_ENCRYPTION', 'MAIL_ENCRYPTIONS', 'MAIL_FROM_ADDRESS', 'MAIL_FROM_NAME'));
    }

    public function secure()
    {
        $COMMENT_TEXT_CENSOR = EnvService::getEnv('COMMENT_TEXT_CENSOR');
        $BAIDU_APP_ID = EnvService::getEnv('BAIDU_APP_ID');
        $BAIDU_API_KEY = EnvService::getEnv('BAIDU_API_KEY');
        $BAIDU_SECRET_KEY = EnvService::getEnv('BAIDU_SECRET_KEY');
        $REGISTER_ENABLED = EnvService::getEnv('REGISTER_ENABLED');
        $EMAIL_VERIFIED_ENABLED = EnvService::getEnv('EMAIL_VERIFIED_ENABLED');
        return view('dashboard.secure', compact('COMMENT_TEXT_CENSOR', 'BAIDU_APP_ID', 'BAIDU_API_KEY', 'BAIDU_SECRET_KEY', 'REGISTER_ENABLED', 'EMAIL_VERIFIED_ENABLED'));
    }

    public function scout()
    {
        $SCOUT_ENABLED = EnvService::getEnv('SCOUT_ENABLED');
        $SCOUT_DRIVER = EnvService::getEnv('SCOUT_DRIVER');
        $SCOUT_DRIVERS = EnvService::getEnvScoutDrivers();
        $ALGOLIA_APP_ID = EnvService::getEnv('ALGOLIA_APP_ID');
        $ALGOLIA_SECRET = EnvService::getEnv('ALGOLIA_SECRET');
        $MEILISEARCH_HOST = EnvService::getEnv('MEILISEARCH_HOST');
        $MEILISEARCH_KEY = EnvService::getEnv('MEILISEARCH_KEY');
        return view('dashboard.scout', compact('SCOUT_ENABLED', 'SCOUT_DRIVER', 'SCOUT_DRIVERS', 'ALGOLIA_APP_ID', 'ALGOLIA_SECRET', 'MEILISEARCH_HOST', 'MEILISEARCH_KEY'));
    }

    public function bgImage()
    {
        $BACKGROUND_IMAGE = EnvService::getEnv('BACKGROUND_IMAGE');
        return view('dashboard.background.image', compact('BACKGROUND_IMAGE'));
    }

    public function bgVideo()
    {
        $BACKGROUND_VIDEO = EnvService::getEnv('BACKGROUND_VIDEO');
        return view('dashboard.background.video', compact('BACKGROUND_VIDEO'));
    }
}
