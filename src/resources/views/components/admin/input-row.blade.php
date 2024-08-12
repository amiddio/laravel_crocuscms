@props(['name', 'label', 'value' => '', 'required' => false])

<div class="mb-6">
    <label for="{{ $name }}" class="block mb-2 text-gray-900 dark:text-white">{{ $label }} @if($required) <span class="text-red-800">*</span> @endif</label>
    <input id="{{ $name }}"
           name="{{ $name }}"
           value="{{ $value }}"
           @if($required) required @endif
           {!! $attributes->merge(['class' => 'shadow-sm bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light']) !!}
    />
    <x-admin.input-error :messages="$errors->get($name)"/>
</div>
