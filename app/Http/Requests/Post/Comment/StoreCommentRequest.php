<?php

namespace App\Http\Requests\Post\Comment;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // 'post_id' => 'required|exists:posts,id',
            'content' => ['required', 'string'],
            'parent_id' => ['nullable', 'exists:comments,id'],
            'user_id' => ['required', 'exists:users,id'],
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge(['user_id' => $this->user()->id]);
    }
}
