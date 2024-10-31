<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        if($this->method() == 'POST') {
            return [
                'name' => 'required|string|max:50',
                'email' => 'required|email|unique:users,email',
                'roles' => 'nullable|string|in:ADMIN,USER'
            ];
        } else if($this->method() == 'PUT') {
            return [
                'name' => 'required|string|max:50',
                'email' => 'required|email',
                'roles' => 'nullable|string|in:ADMIN,USER'
            ];
        } else {
            return [];
        }
    }
}
