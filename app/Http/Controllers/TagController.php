<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Models\Post;
use App\Services\PostManager;
use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all()->map->only(['id', 'name']);

        return response()->json($tags);
    }

    public function search(Request $request)
    {
        $tags = Tag::where('name', 'LIKE', '%' . $request->q . '%')->get();

        return response()->json($tags);
    }

    public function store(Request $request)
    {
        $tag = Tag::create(['name' => $request->name]);

        return response()->json($tag);
    }

    public function createPostsTag(Request $request, Post $post)
    {
        $tagId = $request->tag_id;
        PostManager::createPostsTag($post->ulid, $tagId);
        return response()->json(['message' => 'success']);
    }

    public function getPostsTag(Post $post)
    {
        $postTags = PostManager::getPostsTagsJson($post->ulid);
        return response()->json($postTags);
    }

    public function destroyPostsTag(Request $request, Post $post)
    {
        $tagId = $request->tag_id;
        PostManager::destroyPostsTag($post->ulid, $tagId);
        return response()->json(['message' => 'success']);
    }
}
