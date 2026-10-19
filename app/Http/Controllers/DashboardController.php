<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    public function dashboard(){
        $users = User::with('roles')
            ->whereDate('created_at',now())
            ->orderByDesc('created_at')
            ->paginate(5);

        return view('admin.dashboard', [
            'users' => $users,
            'role_count' => Role::query()->count(),
            'post_count' => Post::query()->count(),
            'user_count' => User::query()->count(),
            'categories_count' => Category::query()->count(),
        ]);
    }
    public function getUsersIndex(){
        $users = User::with('roles')
            ->paginate(7);
        return view('admin.users.index',
        [
            'users' => $users,
        ]
        );
    }

    public function getCategoryIndex(){
        return view('admin.categories.index');
    }

    public function getRolesIndex(){
        return view('admin.roles.index');
    }
}
