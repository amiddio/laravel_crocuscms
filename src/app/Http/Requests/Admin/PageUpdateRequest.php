<?php

namespace App\Http\Requests\Admin;

use App\Models\Page;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;

class PageUpdateRequest extends FormRequest
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
        $rules = [
            'name' => ['required', 'max:50', Rule::unique(Page::class, 'name')->ignore($this->route()->parameter('page'))],
            'is_active' => ['present', 'in:0,1'],
        ];

        foreach (config('translatable.locales') as $locale) {
            Arr::set($rules, 'title:'.$locale, ['required', 'max:255']);
            Arr::set($rules, 'intro:'.$locale, ['present']);
            Arr::set($rules, 'content:'.$locale, ['present']);
        }

        return $rules;
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        $messages = [
            'name.required' => 'The name is required.',
            'name.unique' => 'The entered name already exist.',
            'title.required' => 'The title is required.',
        ];

        foreach (config('translatable.locales') as $locale) {
            Arr::set($messages, 'title:'.$locale.'.required', 'The title is required.');
        }

        return $messages;
    }
}
