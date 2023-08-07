<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Post;
use App\Models\PostsTag;
use App\Models\Tag;


class PostManager
{
    /**
     * Get all published articles for the category and its children categories.
     *
     * @param  \App\Models\Category  $category
     * @param  int  $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    static public function getAllPublishedPostsForCategoryAndChildren(Category $category, $perPage = 10)
    {
        $categoryIds = $category->descendants()->pluck('id')->toArray();
        array_unshift($categoryIds, $category['id']);
        return Post::whereIn('category_id', $categoryIds)
            ->where('published', '1')
            ->where('published_at', '<=', now())
            ->orderBy('published_at', 'desc')
            ->paginate($perPage);
    }

    static public function getAllPublishedPostsCountsForCategoryAndChildren(Category $category)
    {
        $categoryIds = $category->descendants()->pluck('id')->toArray();
        array_unshift($categoryIds, $category['id']);
        return Post::whereIn('category_id', $categoryIds)
            ->where('published', '1')
            ->where('published_at', '<=', now())
            ->count();
    }

    static public function getNewestPublishedPostsWithTags($perPage = 10)
    {
        $posts = Post::with('category:id,title,slug')
            ->select('ulid', 'title', 'slug', 'published_at', 'image', 'category_id', 'meta_description', 'meta_keywords')
        	->where('published', '1')
            ->where('published_at', '<=', now())
            ->where('background_image', '0')
            ->orderBy('published_at', 'desc')
            ->paginate($perPage);
        foreach ($posts as $key => $value) {
            $posts[$key]['tags'] = self::getPostsTagsJson($value['id']);
        }
        return $posts;
    }

    static public function getNewestPublishedPostsCounts()
    {
        return Post::where('published', '1')
            ->where('published_at', '<=', now())
            ->count();
    }

    static public function createPostsTag($postId, $tagId)
    {
        return PostsTag::create([
            'post_id' => $postId,
            'tag_id' => $tagId
        ]);
    }

    static public function destroyPostsTag($postId, $tagId)
    {
        return PostsTag::where('post_id', $postId)
            ->where('tag_id', $tagId)
            ->delete();
    }

    static public function getPostsTags($postId)
    {
        return PostsTag::where('post_id', $postId)
            ->get()
            ->toArray();
    }

    static public function getPostsTagsJson($postId)
    {
        $postTagList = self::getPostsTags($postId);
        $postTagsJson = [];
        foreach ($postTagList as $key => $value) {
            $tagInfo = Tag::where('id', $value['tag_id'])->first();
            $postTagsJson[$key]['id'] = $tagInfo['id'];
            $postTagsJson[$key]['name'] = $tagInfo['name'];
        }
        return $postTagsJson;
    }

    static public function getSliderPosts($limit = 10)
    {
        return Post::with('category:id,title,slug')
            ->select('ulid', 'title', 'slug', 'published_at', 'image', 'category_id', 'meta_description', 'meta_keywords')
        	->where('published', '1')
            ->where('published_at', '<=', now())
            ->where('background_image', '1')
            ->orderBy('published_at', 'desc')
            ->limit($limit)
            ->get();
    }
}
