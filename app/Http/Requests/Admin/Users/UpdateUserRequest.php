<?php

namespace App\Http\Requests\Admin\Users;

use App\Enums\RoleEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasRole(RoleEnum::admin) ?? false;
    }

    public function rules(): array
    {
        $user = $this->route('user');

        return [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', Rule::unique('users', 'username')->ignore($user)],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user)],
            'about' => ['nullable', 'string', 'max:160'],
            'roles' => ['sometimes', 'array'],
            'roles.*' => [
                'required',
                'integer',
                'distinct',
                Rule::exists('roles', 'id')->where('guard_name', config('auth.defaults.guard')),
            ],
        ];
    }
}
