<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'firstname' => 'required','string','max:255',
            'lastname' => 'required','string','max:255',
            'username' => 'required|unique:users,username','string','max:255',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:6','confirmed',
            'password_confirmation' => 'required|same:password',

        ];
    }
}
