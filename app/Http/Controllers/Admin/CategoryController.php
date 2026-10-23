<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Categories\StoreCategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    public function getList()
    {
        $categories = Category::query()->paginate(10);

        return view('admin.categories.index', [
            'categories' => $categories,
        ]);
    }

    public function getCreate()
    {
        $categories = Category::query()->whereNull('parent_id')->get();

        return view('admin.categories.create',[
            'categories' => $categories,
        ]);
    }

    public function postCreate(StoreCategoryRequest $request)
    {
        Category::query()->create($request->validated());

        return redirect()->route('admin.categories.list');

    }

    public function putUpdate(Category $category, StoreCategoryRequest $request)
    {
        $category->update($request->validated());

        return redirect()->route('admin.categories.list');
    }

    public function getUpdate(Category $category)
    {
        $categories = Category::query()->whereNull('parent_id')->get();

        return view('admin.categories.create',[
            'category' => $category,
            'categories' => $categories,
        ]);
    }

    public function deleteCategory(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.list');
    }
}
