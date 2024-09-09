<?php

namespace App\Http\Requests\Admin;

use App\Models\Admin\AdminRole;
use Illuminate\Foundation\Http\FormRequest;

class AdminRoleCreateRequest extends FormRequest
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
            'name' => ['required', 'unique:' . AdminRole::class . ',name'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The name of role is required.',
            'name.unique' => 'The entered name already exist.',
        ];
    }
}
