<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getCategoryIndex()
    {
        $categories = Category::query()->paginate(7);
        return view('admin.categories.index',
            [
                'categories' => $categories,
            ]
        );
    }
    public function getCategoryPut(Request $request ,Category $categories)
    {
        $validated = $request->validate([
            'name' => 'required',
            'slug' => 'required',
        ]);
        $categories->update($validated);
        return redirect()->route('admin.getCategories');
    }
    public function getCategoryDelete(Category $categories)
    {
        $categories->delete();

        return redirect()->back();
    }
}
