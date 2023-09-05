<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadController extends Controller
{
    private function upload($file, $folder)
    {
        $disk = Storage::disk(config('filesystems.default'));
        $hash = md5_file($file->getRealPath()); // 获取文件的 MD5 值
        $filePath = $folder . '/' . $hash . '.' . $file->getClientOriginalExtension();
        $exists = $disk->exists($filePath);
        if (!$exists) {
            $path = $disk->putFileAs('', $file, $filePath);
        } else {
            $path = $filePath;
        }
        return $path;
    }

    public function video(Request $request)
    {
        $disk = Storage::disk(config('filesystems.default'));
        $path = $this->upload($request->file('video'), 'videos');
        if ($path) {
            return response()->json([
                'error' => 0,
                'url' => config('filesystems.default') == 'public' ? asset('storage/' . $path) : $disk->url($path)
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
        $path = $this->upload($request->file('image'), 'images');
        if ($path) {
            return response()->json([
                'error' => 0,
                'url' => config('filesystems.default') == 'public' ? asset('storage/' . $path) : $disk->url($path)
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
        $path = $this->upload($request->file('file'), 'files');
        if ($path) {
            return response()->json([
                'error' => 0,
                'url' => config('filesystems.default') == 'public' ? asset('storage/' . $path) : $disk->url($path)
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
                'url' => config('filesystems.default') == 'public' ? asset('storage/' . $request->input('path')) : $disk->url($request->input('path'))
            ]);
        } else {
            return response()->json([
                'code' => 404,
                'message' => '文件不存在'
            ]);
        }
    }
}
