<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SelectSearchController extends Controller
{
    public function getCategories(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'q' => ['nullable', 'string', 'max:100'],
        ]);

        $search = trim($validated['q'] ?? '');

        if ($search === '') {
            return response()->json([]);
        }

        $categories = Category::query()
            ->where('name', 'like', '%'.addcslashes($search, '\\%_').'%')
            ->orderBy('name')
            ->get(['name', 'slug']);

        return response()->json($categories->map(fn (Category $category): array => [
            'value' => $category->slug,
            'text' => $category->name,
        ])->values());
    }

    public function getUsers(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'q' => ['nullable', 'string', 'max:100', 'min:3'],
        ]);

        $search = trim($validated['q'] ?? '');

        if ($search === '') {
            return response()->json([]);
        }

        $users = User::query()
            ->select(['id', 'username', 'email', 'firstname', 'lastname'])
            ->where('username', 'like', '%'.$search.'%')
            ->limit(10)
            ->orderBy('username')
            ->get();

        return response()->json($users->map(fn (User $user): array => [
            'value' => $user->username,
            'text' => $user->getFullName().' ('.$user->email.')',
        ])->values());
    }
}
