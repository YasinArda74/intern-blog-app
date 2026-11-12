<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\Users\UpdateUserRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
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
            ->whereDate('created_at', now())
            ->orderByDesc('created_at')
            ->paginate(5);

        return view('admin.dashboard', [
            'users' => $users,
            'summary' => $this->getDashboardSummary(),
        ]);
    }

    public function getUsersIndex()
    {
        $users = User::query()
            ->with('roles')
            ->when(request()->has('username'), function ($query) {
                $query->where('username', request()->input('username'));
            })
            ->paginate(7);

        return view('admin.users.index', [
            'users' => $users,
        ]);
    }
    public function getUsersEdit(User $user)
    {
        $roles = Role::query()
            ->where('guard_name', config('auth.defaults.guard'))
            ->orderBy('name')
            ->get();

        $user->load('roles');

        return view('admin.users.edit', [
            'user' => $user,
            'roles' => $roles,
        ]);
    }

    public function putUsersEdit(UpdateUserRequest $request, User $user): JsonResponse
    {
        $validated = $request->validated();

        try {
            DB::transaction(function () use ($user, $validated): void {
                $user->update($validated);

                $user->syncRoles($validated['roles'] ?? []);
            });
        } catch (\Throwable $exception) {
            return $this->returnErrorResponse('An error occurred while updating the user.');
        }

        return $this->returnSuccessResponse(
            'User updated',
            route('admin.getUsersEdit', $user)
        );
    }

    public function usersDelete(User $user)
    {
        $user->delete();

        return $this->returnSuccessResponse('User deleted', route('admin.getUsers'));
    }

    public function getRolAsPermissions()
    {
        return view('admin.role-permissions.index');
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
