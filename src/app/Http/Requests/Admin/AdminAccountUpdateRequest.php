<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class AdminAccountUpdateRequest extends FormRequest
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
            'avatar' => [File::image()->max('5mb')->dimensions(
                Rule::dimensions()->minWidth(60)->minHeight(60)->maxWidth(600)->maxHeight(600)
            )],
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.min' => __('The name must be at least :min characters long.'),
            'name.max' => __('The name must not be greater than :max characters.'),
        ];
    }
}
