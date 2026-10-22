<?php

namespace App\Http\Requests\Admin\Categories;

use App\Enums\RoleEnum;
use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            'parent_category_slug' => ['nullable', 'exists:categories,slug'],
            'parent_id' => ['nullable'],
        ];
    }

    public function prepareForValidation(): void
    {
        $category = Category::query()
            ->where('slug', $this->input('parent_category_slug'))
            ->first();

        $this->merge(['parent_id' => $category->id ?? null]);
    }
}
