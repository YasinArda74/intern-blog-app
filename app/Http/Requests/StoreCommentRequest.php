<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation(): void
    {

    }

    public function rules(): array
    {
        return [
            'post_id' => 'required|exists:posts,id',
            'content' => ['required', 'string'],
            'parent_id' => ['nullable', 'exists:comments,id'],
        ];
    }
}
