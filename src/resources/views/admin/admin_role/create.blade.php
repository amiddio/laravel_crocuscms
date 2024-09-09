<x-admin-app-layout>
    <x-slot name="page_title">{{ __('Admin Role Create') }}</x-slot>

    <x-slot name="content">

        <div class="text-right space-x-4">
            <a
                href="{{ url()->previous() }}"
                class="text-secondary transition duration-150 ease-in-out hover:text-secondary-600 focus:text-secondary-600 active:text-secondary-700"
            >{{ __('Back') }}</a>
            <a
                href="{{ route('admin.admin_roles.index') }}"
                class="text-secondary transition duration-150 ease-in-out hover:text-secondary-600 focus:text-secondary-600 active:text-secondary-700"
            >{{ __('List') }}</a>
        </div>
        <hr class="mt-3 mb-6" />

        <form method="post" action="{{ route('admin.admin_roles.store') }}">
            @csrf
            <x-admin.input-row type="text" :name="'name'" :label="__('Name')" :value="old('name')" :required="true" autofocus />
            <x-admin.button-primary :label="__('Create')"/>
        </form>

    </x-slot>
</x-admin-app-layout>
