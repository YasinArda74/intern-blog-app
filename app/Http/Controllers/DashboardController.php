<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        if ($request->boolean('refreshSummary')) {
            $this->clearDashboardSummaryCache();

            return redirect()->route('admin.dashboard', $request->except('refreshSummary'));
        }

        $users = User::with('roles')
            ->whereDate('created_at',now())
            ->orderByDesc('created_at')
            ->paginate(5);

        return view('admin.dashboard', [
            'users' => $users,
            'summary' => $this->getDashboardSummary(),
        ]);
    }

    public function getUsersIndex(){
        $users = User::with('roles')->paginate(7);

        return view('admin.users.index', [
            'users' => $users,
        ]);
    }

    public function getCategoryIndex(){
        return view('admin.categories.index');
    }

    public function getRolesIndex(){
        return view('admin.roles.index');
    }

    // Private methods
    private function getDashboardSummary()
    {
        $now = now();

        $roleCount = Cache::remember('roleCount', $now->addMinutes(30), function () {
            return Role::query()->count();
        });

        $postCount = Cache::remember('postCount', $now->addMinutes(30), function () {
            return Post::query()->count();
        });

        $userCount = Cache::remember('userCount', $now->addMinutes(30), function () {
            return User::query()->count();
        });

        $categoryCount = Cache::remember('categoryCount', $now->addMinutes(30), function () {
            return Category::query()->count();
        });

        return [
            'roleCount' => $roleCount,
            'postCount' => $postCount,
            'userCount' => $userCount,
            'categoryCount' => $categoryCount,
        ];
    }

    private function clearDashboardSummaryCache()
    {
        Cache::forget('roleCount');
        Cache::forget('postCount');
        Cache::forget('userCount');
        Cache::forget('categoryCount');
    }
}
