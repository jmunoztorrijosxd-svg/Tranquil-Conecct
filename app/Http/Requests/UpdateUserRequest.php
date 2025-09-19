<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('user'); // Laravel lo resuelve por Route Model Binding
        return [
            'name' => 'required|string|max:50',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($id),
            ],
            'password' => 'nullable|string|min:8|confirmed',
        ];
    }
}
