<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadController extends Controller
{
    public function video(Request $request)
    {
        $disk = Storage::disk(config('filesystems.default'));
        $file = $request->file('video'); // 假设从请求中获取到的文件
        $hash = md5_file($file->getRealPath()); // 获取文件的 MD5 值
        $filePath = 'videos/' . $hash . '.' . $file->getClientOriginalExtension();
        $exists = $disk->exists($filePath);
        if (!$exists) {
            $path = $disk->putFileAs('', $file, $filePath);
        } else {
            $path = $filePath;
        }
        if ($path) {
            return response()->json([
                'error' => 0,
                'url' => $disk->url($path)
            ]);
        } else {
            return response()->json([
                'error' => 1,
                'message' => '上传失败'
            ]);
        }
    }

    public function image(Request $request)
    {
        $disk = Storage::disk(config('filesystems.default'));
        $file = $request->file('image'); // 假设从请求中获取到的文件
        $hash = md5_file($file->getRealPath()); // 获取文件的 MD5 值
        $filePath = 'images/' . $hash . '.' . $file->getClientOriginalExtension();
        $exists = $disk->exists($filePath);
        if (!$exists) {
            $path = $disk->putFileAs('', $file, $filePath);
        } else {
            $path = $filePath;
        }
        if ($path) {
            return response()->json([
                'error' => 0,
                'url' => $disk->url($path)
            ]);
        } else {
            return response()->json([
                'error' => 1,
                'message' => '上传失败'
            ]);
        }
    }

    public function file(Request $request)
    {
        $disk = Storage::disk(config('filesystems.default'));
        $file = $request->file('file'); // 假设从请求中获取到的文件
        $hash = md5_file($file->getRealPath()); // 获取文件的 MD5 值
        $filePath = 'files/' . $hash . '.' . $file->getClientOriginalExtension();
        $exists = $disk->exists($filePath);
        if (!$exists) {
            $path = $disk->putFileAs('', $file, $filePath);
        } else {
            $path = $filePath;
        }
        if ($path) {
            return response()->json([
                'error' => 0,
                'url' => $disk->url($path)
            ]);
        } else {
            return response()->json([
                'error' => 1,
                'message' => '上传失败'
            ]);
        }
    }

    public function checkExists(Request $request)
    {
        $disk = Storage::disk(config('filesystems.default'));
        $exists = $disk->exists($request->input('path'));
        if ($exists) {
            return response()->json([
                'code' => 200,
                'url' => $disk->url($request->input('path'))
            ]);
        } else {
            return response()->json([
                'code' => 404,
                'message' => '文件不存在'
            ]);
        }
    }
}
