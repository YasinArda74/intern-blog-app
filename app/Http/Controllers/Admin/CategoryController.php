<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Categories\StoreCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getList()
    {
        $categories = Category::query();

        $parentCategories = $categories->whereNull('parent_id')->get();

        return view('admin.categories.index', [
            'categories' => $categories->paginate(10),
            'parentCategories' => $parentCategories,
        ]);
    }

    public function putUpdate(Category $categories, StoreCategoryRequest $request)
    {
        $categories->update($request->validated());

        return redirect()->route('admin.categories.list');
    }

    public function deleteCategory(Category $categories)
    {
        $categories->delete();

        return redirect()->back();
    }
}
