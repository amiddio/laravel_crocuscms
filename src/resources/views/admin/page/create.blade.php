<x-admin-app-layout>
    <x-slot name="page_title">{{ __('Page Create') }}</x-slot>

    <x-slot name="content">
        <div class="text-right space-x-4">
            <a
                href="{{ url()->previous() }}"
                class="text-secondary transition duration-150 ease-in-out hover:text-secondary-600 focus:text-secondary-600 active:text-secondary-700"
            >{{ __('Back') }}</a>
            <a
                href="{{ route('admin.pages.index') }}"
                class="text-secondary transition duration-150 ease-in-out hover:text-secondary-600 focus:text-secondary-600 active:text-secondary-700"
            >{{ __('List') }}</a>
        </div>
        <hr class="mt-3 mb-6" />
        <form method="post" action="{{ route('admin.pages.store') }}">
            @csrf
            <x-admin.input-row type="text" :name="'name'" :label="__('Name')" :value="old('name')" :required="true" autofocus />
            <x-admin.input-row type="text" :name="'title'" :label="__('Title')" :value="old('title')" :required="true" />
            <x-admin.textarea-row :name="'intro'" :label="__('Intro')" :value="old('intro')" :rows="'3'" />
            <x-admin.textarea-row :name="'content'" :label="__('Content')" :value="old('content')" :rows="'10'" />
            <x-admin.checkbox :name="'is_active'" :label="__('Is active?')" :checked="old('is_active')" />
            <x-admin.button-primary :label="__('Create')"/>
        </form>
    </x-slot>
</x-admin-app-layout>
