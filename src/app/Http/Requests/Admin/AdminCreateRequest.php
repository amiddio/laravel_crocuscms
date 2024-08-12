<?php

namespace App\Http\Requests\Admin;

use App\Models\Admin\Admin;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class AdminCreateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['nullable', 'min:3', 'max:30'],
            'login' => ['required', 'lowercase', 'min:3', 'max:30', 'unique:' . Admin::class . ',login'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'password_confirmation' => ['required'],
            'is_active' => ['present', 'in:0,1'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.min' => 'The name must be at least :min characters long.',
            'name.max' => 'The name must not be greater than :max characters.',
            'login.required' => 'The login is required.',
            'login.min' => 'The login must be at least :min characters long.',
            'login.max' => 'The login must not be greater than :max characters.',
            'login.lowercase' => 'The login must be lowercase.',
            'login.unique' => 'The entered login already registered.',
            'password.required' => 'The password is required.',
            'password_confirmation.required' => 'The confirm password is required.',
        ];
    }
}
