<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Roles\StoreRoleRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function getList()
    {
        $roles = Role::with('permissions')->get();

        return view('admin.roles.index', [
            'roles' => $roles,
        ]);
    }

    public function getCreate()
    {
        $permissionGroups = Permission::query()
            ->orderBy('name')
            ->get()
            ->groupBy(fn (Permission $permission) => str($permission->name)->before('.')->toString());

        return view('admin.roles.create', [
            'permissionGroups' => $permissionGroups,
        ]);
    }

    public function postCreate(StoreRoleRequest $request)
    {
        try {
            $inputs = $request->validated();

            DB::transaction(function () use ($inputs) {
                $role = Role::create(['name' => $inputs['name']]);

                if (! empty($inputs['permissions'])) {
                    $role->syncPermissions($inputs['permissions']);
                }
            });
        } catch (\Throwable $exception) {
            Log::error('Role creation error: '.$exception);

            return $this->returnErrorResponse('An error occurred while creating the role.');
        }

        return $this->returnSuccessResponse('Role created successfully.', route('admin.roles.list'));
    }

    public function getEdit(Role $role)
    {
        $permissionGroups = Permission::query()
            ->orderBy('name')
            ->get()
            ->groupBy(fn (Permission $permission) => str($permission->name)->before('.')->toString());

        return view('admin.roles.create', [
            'permissionGroups' => $permissionGroups,
            'role' => $role,
        ]);
    }

    public function putUpdate(Role $role, StoreRoleRequest $request)
    {
        try {
            $inputs = $request->validated();

            DB::transaction(function () use ($inputs, $role) {
                $role->update(['name' => $inputs['name']]);

                if (! empty($inputs['permissions'])) {
                    $role->syncPermissions($inputs['permissions']);
                }
            });
        } catch (\Throwable $exception) {
            Log::error('Role updating error: '.$exception);

            return redirect()->back()->withErrors(['error' => 'An error occurred while updating the role.']);
        }

        return redirect()->route('admin.roles.list');
    }

    public function getDelete(Role $role)
    {
        $role->delete();

        return redirect()->route('admin.roles.list');
    }
}
