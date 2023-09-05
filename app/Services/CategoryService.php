<?php

namespace App\Services;

use App\Models\Category;
class CategoryService
{
    static public function getCategories($parentId = null, $depth = 0)
    {
        $categories = Category::where('parent_id', $parentId)->get();
        $result = [];

        foreach ($categories as $category) {
            $category->depth = $depth;
            $result[] = $category;
            $result = array_merge($result, self::getCategories($category->id, $depth + 1));
        }

        return $result;
    }

    static public function getTopCategories()
    {
        return Category::whereNull('parent_id')->get();
    }

    static public function getTreeCategories($categories, $depth = 0)
    {
        $result = [];
        foreach ($categories as $key => $category) {
            if ($depth == 0) {
                $result[$depth.$key]['id'] = $category->id;
                $result[$depth.$key]['title'] = $category->title;
            } else {
                $result[$depth.$key]['id'] = $category->id;
                $result[$depth.$key]['title'] = str_repeat('　', $depth/2) . '┗' . $category->title;
            }
            if ($category->children) {
                $result = array_merge($result, self::getTreeCategories($category->children, $depth + 1));
            }
        }

        return $result;
    }
}
