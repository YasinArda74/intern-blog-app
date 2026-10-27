<?php

namespace App\Http\Requests\Admin\Tags;

use App\Enums\RoleEnum;
use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class StoreTagsRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Eğer kullanıcı admin değilse engelle
        if (! $this->user()->hasRole(RoleEnum::admin)) {
            return false;
        }

        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'is_active' => ['required', 'boolean'],
            'slug' => ['nullable', 'max:255'],
        ];
    }

    public function prepareForValidation(): void
    {
        $category = Category::query()
            ->where('slug', $this->input('slug'))
            ->first();
    }
}
