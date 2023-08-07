<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UploadService
{
    /**
     * 上传文件到七牛云
     *
     * @param UploadedFile $file
     * @param string $path
     * @return string|null
     */
    public function uploadToQiniu(UploadedFile $file, $path = '')
    {
        $disk = Storage::disk('qiniu');
        $extension = $file->getClientOriginalExtension();
        $filename = uniqid() . '.' . $extension;
        $filePath = $path . '/' . $filename;

        if ($disk->put($filePath, file_get_contents($file))) {
            return $disk->url($filePath);
        }

        return null;
    }
}

