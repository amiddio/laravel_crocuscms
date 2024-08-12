<x-admin-app-layout>
    <x-slot name="page_title">{{ __('Admin Create') }}</x-slot>

    <x-slot name="content">

        <div class="text-right space-x-4">
            <a
                href="{{ url()->previous() }}"
                class="text-secondary transition duration-150 ease-in-out hover:text-secondary-600 focus:text-secondary-600 active:text-secondary-700"
            >{{ __('Back') }}</a>
            <a
                href="{{ route('admin.admins.index') }}"
                class="text-secondary transition duration-150 ease-in-out hover:text-secondary-600 focus:text-secondary-600 active:text-secondary-700"
            >{{ __('List') }}</a>
        </div>
        <hr class="mt-3 mb-6" />

        <form method="post" action="{{ route('admin.admins.store') }}">
            @csrf
            <x-admin.input-row type="text" :name="'name'" :label="__('Name')" :value="old('name')" />
            <x-admin.input-row type="text" :name="'login'" :label="__('Login')" :value="old('login')" :required="true" autofocus />
            <x-admin.input-row type="password" :name="'password'" :label="__('Password')" :required="true" />
            <x-admin.input-row type="password" :name="'password_confirmation'" :label="__('Confirm Password')" :required="true" />
            <x-admin.checkbox :name="'is_active'" :label="__('Is active?')" :checked="true" />
            <x-admin.button-primary :label="__('Create')"/>
        </form>

    </x-slot>
</x-admin-app-layout>
