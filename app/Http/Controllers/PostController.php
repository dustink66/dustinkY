<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Services\CategoryService;
use App\Services\PostService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //获取分页数据
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        //渲染视图
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ulid = Str::ulid();
        Post::create([
            'ulid' => $ulid,
            'title' => trans('This article was created on') . date('Y-m-d H:i:s'),
            'slug' => Str::uuid(),
            'content' => 'new content',
            'background_image' => false,
            'user_id' => Auth::id(),
            'category_id' => DB::table('categories')->first()->id,
            'views' => 0,
            'meta_description' => env('APP_DESCRIPTION'),
            'meta_keywords' => env('APP_KEYWORDS'),
            'published_at' => date('Y-m-d H:i:s')
        ]);

        Toast::success(trans('Post created successfully!'))->autoDismiss(5);

        return redirect()->route('posts.edit', $ulid);
    }

    public function comment(Post $post)
    {
        return view('posts.comment', [
            'comments' => SpladeTable::for($post->comments()->getQuery())
                ->withGlobalSearch(columns: ['id', 'user.name', 'content'])
                ->column('id', sortable: true)
                ->column('user.name', 'Comment User', sortable: true)
                ->column('content', 'Comment Content', sortable: true)
                ->column('created_at', 'Comment Created At', sortable: true)
                ->column(label: 'Actions')
                ->paginate(15),
            'post' => $post,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //判断文章是否发布
        if (!$post->published) {
            abort(404);
        }
        $post->timestamps = false; // 关闭自动更新时间戳
        $post->increment('views');
        $post->with('category', 'user', 'tags');

        $tags = PostService::getPostsTagsJson($post->ulid);

        if ($post->background_image && $post->image !== '') {
            \Illuminate\Support\Facades\View::share('BACKGROUND_IMAGE', $post->image);
            \Illuminate\Support\Facades\View::share('BACKGROUND_TYPE', 'image');
        }
        return view('posts.show', compact('post', 'tags'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = CategoryService::getCategories();
        return view('posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->update($request->validated());

        return response()->json($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        Toast::success(trans('Post deleted successfully!'))->autoDismiss(5);
        return redirect()->route('posts.index');
    }
}
