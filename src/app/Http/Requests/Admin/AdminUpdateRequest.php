<?php

namespace App\Http\Requests\Admin;

use App\Models\Admin\Admin;
use App\Models\Admin\AdminRole;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class AdminUpdateRequest extends FormRequest
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
            'password' => ['nullable', 'confirmed', Password::defaults()],
            'password_confirmation' => ['nullable'],
            'is_active' => ['present', 'in:0,1'],
            'admin_role_id' => ['required', 'exists:'.AdminRole::class.',id'],
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
            'password.required' => 'The password is required.',
            'password_confirmation.required' => 'The confirm password is required.',
            'admin_role_id.required' => 'Admin role is required.',
            'admin_role_id.exists' => 'Selected admin role is not exist.',
        ];
    }
}
