<?php

namespace App\Http\Requests\Post;

use App\Enums\RoleEnum;
use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreatePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        if (! $this->user()->hasRole([
            RoleEnum::admin->value,
            RoleEnum::author->value,
        ])) {
            return false;
        }

        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => ['required', 'exists:users,id'],
            'title' => ['required', 'max:255'],
            'content' => ['required'],
            'excerpt' => ['required'],
            'category_id' => ['required', 'exists:categories,id'],
            'scheduled_at' => [
                'nullable',
                Rule::date()->afterToday(),
                Rule::requiredIf($this->boolean('published_at_feature')),
            ],
            'published_at_feature' => ['nullable'],
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => trans('Title'),
            'content' => trans('Article content'),
            'excerpt' => trans('Brief summary'),
            'category_id' => trans('Category'),
            'scheduled_at' => trans('Scheduled At'),
            'published_at_feature' => trans('Published At Feature'),
        ];
    }

    /**
     * Bu metot köprüden önceki son çıkıştır. Backend tarafına istek gönderildiğinde validation çalıştırılmadan önce burası çalışır.
     * Controller tarafında $request->validated() çalıştırılırsa bu metot içerisindeki merge edilen değerlerinde rules metodunda olması gerekiyor
     */
    public function prepareForValidation(): void
    {
        $category = Category::query()
            ->where('slug', $this->input('category_slug'))
            ->first();

        $this->merge([
            'user_id' => $this->user()->id,
            'category_id' => $category->id ?? null,
            'scheduled_at' => $this->boolean('published_at_feature')
                ? $this->input('scheduled_at')
                : null,
        ]);
    }
}
