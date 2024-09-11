@props(['name', 'label', 'rows', 'value' => '', 'required' => false])

<div class="mb-6">
    <label for="{{ $name }}" class="block mb-2 text-gray-900 dark:text-white">{{ $label }} @if($required) <span class="text-red-800">*</span> @endif</label>
    <textarea
        name="{{ $name }}"
        rows="{{ $rows }}"
        @if($required) required @endif
        {!! $attributes->merge(['class' => 'peer block min-h-[auto] w-full rounded bg-gray-50 border border-gray-300 text-gray-900 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[twe-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-white dark:placeholder:text-neutral-300 dark:peer-focus:text-primary [&:not([data-twe-input-placeholder-active])]:placeholder:opacity-0']) !!}
        >{{ $value }}</textarea>
        <x-admin.input-error :messages="$errors->get($name)"/>
</div>
