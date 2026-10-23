<?php

namespace App\Http\Requests\Admin\Roles;

use App\Enums\RoleEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        if (! $this->user()->hasRole(RoleEnum::admin)) {
            return false;
        }

        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('roles', 'name')->ignore($this->route('role'))],
            'permissions' => ['nullable', 'array'],
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'permissions' => $this->enabledPermissionNames($this->input('permissions')),
        ]);
    }

    private function enabledPermissionNames(array $permissions): array
    {
        return array_keys(array_filter(
            $permissions,
            fn (mixed $enabled): bool => in_array($enabled, ['1', 1, true], true),
        ));
    }
}
