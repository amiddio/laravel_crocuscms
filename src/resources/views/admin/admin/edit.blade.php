<x-admin-app-layout>
    <x-slot name="page_title">{{ __('Admin \':admin\' Edit', ['admin' => $admin->login]) }}</x-slot>

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
            <a
                href="{{ route('admin.admins.show', $admin->id) }}"
                class="text-info transition duration-150 ease-in-out hover:text-info-600 focus:text-info-600 active:text-info-700"
            >{{ __('Show') }}</a>
            <a
                href="{{ route('admin.admins.create') }}"
                class="text-primary transition duration-150 ease-in-out hover:text-primary-600 focus:text-primary-600 active:text-primary-700 dark:text-primary-400 dark:hover:text-primary-500 dark:focus:text-primary-500 dark:active:text-primary-600"
            >{{ __('Create') }}</a>
            <a
                href="#!"
                class="text-danger transition duration-150 ease-in-out hover:text-danger-600 focus:text-danger-600 active:text-danger-700"
                data-twe-toggle="modal"
                data-twe-target="#deleteAdmin"
            >{{ __('Delete') }}</a>
        </div>
        <hr class="mt-3 mb-6" />

        <form method="post" action="{{ route('admin.admins.update', $admin->id) }}">
            @csrf
            @method('put')
            <x-admin.input-row type="text" :name="'name'" :label="__('Name')" :value="old('name', $admin->name)" />
            <x-admin.input-row type="password" :name="'password'" :label="__('Password')" />
            <x-admin.input-row type="password" :name="'password_confirmation'" :label="__('Confirm Password')" />
            <x-admin.checkbox :name="'is_active'" :label="__('Is active?')" :checked="old('is_active', (bool)$admin->is_active)" />
            <x-admin.button-primary :label="__('Save')"/>
        </form>

        <x-admin.modal :id="'deleteAdmin'" :title="__('Delete Admin')" :button="'Delete'">
            <form method="post" action="{{ route('admin.admins.destroy', $admin->id) }}" id="deleteAdmin-form">
                @csrf
                @method('delete')
                <p>
                    {{ __('Are you sure you want to delete admin \':login\'?', ['login' => $admin->login]) }}
                </p>
            </form>
        </x-admin.modal>

    </x-slot>
</x-admin-app-layout>
