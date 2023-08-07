<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use App\Services\EnvServices;
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
            if(EnvServices::updateEnv($attributeName, $request->input($attributeName))) {
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
        $APP_SWITCH = EnvServices::getEnv('APP_SWITCH');
        $APP_NAME = EnvServices::getEnv('APP_NAME');
        $APP_URL = EnvServices::getEnv('APP_URL');
        $APP_SWITCH_MESSAGE = EnvServices::getEnv('APP_SWITCH_MESSAGE');
        $APP_KEYWORDS = EnvServices::getEnv('APP_KEYWORDS');
        $APP_DESCRIPTION = EnvServices::getEnv('APP_DESCRIPTION');
        $ICP_NUMBER = EnvServices::getEnv('ICP_NUMBER');
        $APP_TIMEZONE = EnvServices::getEnv('APP_TIMEZONE');
        $APP_TIMEZONES = EnvServices::getEnvTimezone();
        $APP_LOCALE = EnvServices::getEnv('APP_LOCALE');
        $APP_LOCALES = EnvServices::getEnvLocale();
        $APP_FONT_FAMILY = EnvServices::getEnv('APP_FONT_FAMILY');
        return view('dashboard.setting', compact('APP_SWITCH','APP_NAME', 'APP_URL', 'APP_SWITCH_MESSAGE', 'APP_KEYWORDS', 'APP_DESCRIPTION', 'ICP_NUMBER', 'APP_TIMEZONE', 'APP_TIMEZONES', 'APP_LOCALE', 'APP_LOCALES', 'APP_FONT_FAMILY'));
    }

    public function storage()
    {
        $FILESYSTEM_DISK = EnvServices::getEnv('FILESYSTEM_DISK');
        $FILESYSTEM_DISKS = EnvServices::getEnvDisks();
        $QINIU_ACCESS_KEY = EnvServices::getEnv('QINIU_ACCESS_KEY');
        $QINIU_SECRET_KEY = EnvServices::getEnv('QINIU_SECRET_KEY');
        $QINIU_BUCKET = EnvServices::getEnv('QINIU_BUCKET');
        $QINIU_DOMAIN = EnvServices::getEnv('QINIU_DOMAIN');
        return view('dashboard.storage', compact('FILESYSTEM_DISK', 'FILESYSTEM_DISKS', 'QINIU_ACCESS_KEY', 'QINIU_SECRET_KEY', 'QINIU_BUCKET', 'QINIU_DOMAIN'));
    }

    public function socialite()
    {
        $SOCIALITE_ENABLED = EnvServices::getEnv('SOCIALITE_ENABLED');
        $GITHUB_CLIENT_ID = EnvServices::getEnv('GITHUB_CLIENT_ID');
        $GITHUB_CLIENT_SECRET = EnvServices::getEnv('GITHUB_CLIENT_SECRET');
        $QQ_CLIENT_ID = EnvServices::getEnv('QQ_CLIENT_ID');
        $QQ_CLIENT_SECRET = EnvServices::getEnv('QQ_CLIENT_SECRET');
        $GITEE_CLIENT_ID = EnvServices::getEnv('GITEE_CLIENT_ID');
        $GITEE_CLIENT_SECRET = EnvServices::getEnv('GITEE_CLIENT_SECRET');
        $OUTLOOK_CLIENT_ID = EnvServices::getEnv('OUTLOOK_CLIENT_ID');
        $OUTLOOK_CLIENT_SECRET = EnvServices::getEnv('OUTLOOK_CLIENT_SECRET');
        $WEIBO_CLIENT_ID = EnvServices::getEnv('WEIBO_CLIENT_ID');
        $WEIBO_CLIENT_SECRET = EnvServices::getEnv('WEIBO_CLIENT_SECRET');
        return view('dashboard.socialite', compact('SOCIALITE_ENABLED', 'GITHUB_CLIENT_ID', 'GITHUB_CLIENT_SECRET', 'QQ_CLIENT_ID', 'QQ_CLIENT_SECRET', 'GITEE_CLIENT_ID', 'GITEE_CLIENT_SECRET', 'OUTLOOK_CLIENT_ID', 'OUTLOOK_CLIENT_SECRET', 'WEIBO_CLIENT_ID', 'WEIBO_CLIENT_SECRET'));
    }

    public function master()
    {
        $WEBMASTER_NAME = EnvServices::getEnv('WEBMASTER_NAME');
        $WEBMASTER_EMAIL = EnvServices::getEnv('WEBMASTER_EMAIL');
        $WEBMASTER_AVATAR = EnvServices::getEnv('WEBMASTER_AVATAR');
        return view('dashboard.master', compact('WEBMASTER_NAME', 'WEBMASTER_EMAIL', 'WEBMASTER_AVATAR'));
    }

    public function mail()
    {
        $MAIL_MAILER = EnvServices::getEnv('MAIL_MAILER');
        $MAIL_MAILERS = EnvServices::getEnvMailers();
        $MAIL_HOST = EnvServices::getEnv('MAIL_HOST');
        $MAIL_PORT = EnvServices::getEnv('MAIL_PORT');
        $MAIL_USERNAME = EnvServices::getEnv('MAIL_USERNAME');
        $MAIL_PASSWORD = EnvServices::getEnv('MAIL_PASSWORD');
        $MAIL_ENCRYPTION = EnvServices::getEnv('MAIL_ENCRYPTION');
        $MAIL_ENCRYPTIONS = EnvServices::getEnvMailEncryption();
        $MAIL_FROM_ADDRESS = EnvServices::getEnv('MAIL_FROM_ADDRESS');
        $MAIL_FROM_NAME = EnvServices::getEnv('MAIL_FROM_NAME');
        return view('dashboard.mail', compact('MAIL_MAILER', 'MAIL_MAILERS', 'MAIL_HOST', 'MAIL_PORT', 'MAIL_USERNAME', 'MAIL_PASSWORD', 'MAIL_ENCRYPTION', 'MAIL_ENCRYPTIONS', 'MAIL_FROM_ADDRESS', 'MAIL_FROM_NAME'));
    }

    public function secure()
    {
        $COMMENT_TEXT_CENSOR = EnvServices::getEnv('COMMENT_TEXT_CENSOR');
        $BAIDU_APP_ID = EnvServices::getEnv('BAIDU_APP_ID');
        $BAIDU_API_KEY = EnvServices::getEnv('BAIDU_API_KEY');
        $BAIDU_SECRET_KEY = EnvServices::getEnv('BAIDU_SECRET_KEY');
        $REGISTER_ENABLED = EnvServices::getEnv('REGISTER_ENABLED');
        $EMAIL_VERIFIED_ENABLED = EnvServices::getEnv('EMAIL_VERIFIED_ENABLED');
        return view('dashboard.secure', compact('COMMENT_TEXT_CENSOR', 'BAIDU_APP_ID', 'BAIDU_API_KEY', 'BAIDU_SECRET_KEY', 'REGISTER_ENABLED', 'EMAIL_VERIFIED_ENABLED'));
    }

    public function scout()
    {
        $SCOUT_ENABLED = EnvServices::getEnv('SCOUT_ENABLED');
        $SCOUT_DRIVER = EnvServices::getEnv('SCOUT_DRIVER');
        $SCOUT_DRIVERS = EnvServices::getEnvScoutDrivers();
        $ALGOLIA_APP_ID = EnvServices::getEnv('ALGOLIA_APP_ID');
        $ALGOLIA_SECRET = EnvServices::getEnv('ALGOLIA_SECRET');
        $MEILISEARCH_HOST = EnvServices::getEnv('MEILISEARCH_HOST');
        $MEILISEARCH_KEY = EnvServices::getEnv('MEILISEARCH_KEY');
        return view('dashboard.scout', compact('SCOUT_ENABLED', 'SCOUT_DRIVER', 'SCOUT_DRIVERS', 'ALGOLIA_APP_ID', 'ALGOLIA_SECRET', 'MEILISEARCH_HOST', 'MEILISEARCH_KEY'));
    }

    public function bgImage()
    {
        $BACKGROUND_IMAGE = EnvServices::getEnv('BACKGROUND_IMAGE');
        return view('dashboard.background.image', compact('BACKGROUND_IMAGE'));
    }

    public function bgVideo()
    {
        $BACKGROUND_VIDEO = EnvServices::getEnv('BACKGROUND_VIDEO');
        return view('dashboard.background.video', compact('BACKGROUND_VIDEO'));
    }
}
