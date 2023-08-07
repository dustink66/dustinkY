<?php

namespace App\Services;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

class EnvServices
{
    /**
     * Get all published articles for the category and its children categories.
     *
     * @param  \App\Models\Category  $category
     * @param  int  $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    static public function getEnv($key)
    {
        return env($key);
    }

    static public function updateEnv($key, $value)
    {
        // 获取当前 .env 文件的内容
        $envFile = base_path('.env');
        $currentEnv = File::get($envFile);

        // 判断 $value 是否包含空格，如果包含则加上双引号
        if (strpos($value, ' ') !== false) {
            $value = '"' . $value . '"';
        }

        // 替换指定键的值
        $newEnv = preg_replace("/^{$key}=.*/m", "{$key}={$value}", $currentEnv);

        // 将修改后的内容写入 .env 文件
        File::put($envFile, $newEnv);

        // 判断写入是否成功，并返回结果
        return File::get($envFile) === $newEnv;
    }


    static public function getEnvDisks()
    {
        $disks = Config::get('filesystems.disks');
        $keys = array_keys($disks);
        $diskProperties = [];
        foreach ($keys as $key) {
            $properties = [
                'code' => $key,
                'name' => trans('filesystems.' . $key),
            ];
            array_push($diskProperties, $properties);
        }
        return $diskProperties;
    }

    static public function getEnvTimezone()
    {
        $timezone = trans('timezone');
        $timezoneProperties = [];
        foreach ($timezone as $key => $value) {
            $properties = [
                'code' => $key,
                'name' => $value
            ];
            array_push($timezoneProperties, $properties);
        }
        return $timezoneProperties;
    }

    static public function getEnvLocale()
    {
        $locale = trans('locale');
        $localeProperties = [];
        foreach ($locale as $key => $value) {
            $properties = [
                'code' => $key,
                'name' => $value
            ];
            array_push($localeProperties, $properties);
        }
        return $localeProperties;
    }

    static public function getEnvMailers()
    {
        return [
            [
                'code' => 'smtp',
                'name' => 'SMTP'
            ],
            [
                'code' => 'sendmail',
                'name' => 'Sendmail'
            ]
        ];
    }

    static public function getEnvMailEncryption()
    {
        return [
            [
                'code' => 'tls',
                'name' => 'TLS'
            ],
            [
                'code' => 'ssl',
                'name' => 'SSL'
            ]
        ];
    }

    static public function getEnvScoutDrivers()
    {
        $scout = trans('scout');
        $scoutProperties = [];
        foreach ($scout as $key => $value) {
            $properties = [
                'code' => $key,
                'name' => $value
            ];
            array_push($scoutProperties, $properties);
        }
        return $scoutProperties;
    }
}
