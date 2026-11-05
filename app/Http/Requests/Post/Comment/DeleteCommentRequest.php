<?php

namespace App\Http\Requests\Post\Comment;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class DeleteCommentRequest extends FormRequest
{
    public function authorize(): bool
    {
        if (! $this->user()) {
            return false;
        }

        return true;
    }

    public function rules(): array
    {
        return [
            'comment_id' => ['required', 'exists:comments,id'],
        ];
    }
}
