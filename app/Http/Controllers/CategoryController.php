<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use App\Services\PostService;
use Illuminate\Support\Facades\Redirect;
use ProtoneMedia\Splade\Facades\Toast;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::defaultOrder()->get()->toTree();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categoryList = Category::defaultOrder()->get()->toTree();
        $categories = CategoryService::getTreeCategories($categoryList, 0);
        return view('categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $category = new Category();
        $category->fill($request->all());
        $category->save();
        Toast::success(trans('Category created successfully!'))->autoDismiss(5);
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //获取栏目极其子栏目下所有文章
        $category = Category::with('children', 'parent')->find($category->id);
        $category->posts_count = PostService::getAllPublishedPostsCountsForCategoryAndChildren($category);
        $posts = PostService::getAllPublishedPostsForCategoryAndChildren($category, 9);
        return view('categories.show', compact('posts', 'posts'), compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $categoryList = Category::defaultOrder()->get()->toTree();
        $categories = CategoryService::getTreeCategories($categoryList, 0);
        return view('categories.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->fill($request->all());
        $category->save();
        Toast::success(trans('Category updated successfully!'))->autoDismiss(5);
        return Redirect::route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        Toast::success(trans('Category deleted successfully!'))->autoDismiss(5);
        return redirect()->route('categories.index');
    }
}
