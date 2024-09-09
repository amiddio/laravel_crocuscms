<x-admin-app-layout>
    <x-slot name="page_title">{{ __('Role \':role\' Edit', ['role' => $role->name]) }}</x-slot>

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
            <a
                href="{{ route('admin.admin_roles.create') }}"
                class="text-primary transition duration-150 ease-in-out hover:text-primary-600 focus:text-primary-600 active:text-primary-700 dark:text-primary-400 dark:hover:text-primary-500 dark:focus:text-primary-500 dark:active:text-primary-600"
            >{{ __('Create') }}</a>
            <a
                href="#!"
                class="text-danger transition duration-150 ease-in-out hover:text-danger-600 focus:text-danger-600 active:text-danger-700"
                data-twe-toggle="modal"
                data-twe-target="#deleteRole"
            >{{ __('Delete') }}</a>
        </div>
        <hr class="mt-3 mb-6" />

        <form method="post" action="{{ route('admin.admin_roles.update', $role->id) }}">
            @csrf
            @method('put')
            <x-admin.input-row type="text" :name="'name'" :label="__('Name')" :value="old('name', $role->name)" :required="true" autofocus />
            <x-admin.button-primary :label="__('Save')"/>
        </form>

        <x-admin.modal :id="'deleteRole'" :title="__('Delete Admin Role')" :button="'Delete'">
            <form method="post" action="{{ route('admin.admin_roles.destroy', $role->id) }}" id="deleteRole-form">
                @csrf
                @method('delete')
                <p>
                    {{ __('Are you sure you want to delete the role \':role\'?', ['role' => $role->name]) }}
                </p>
            </form>
        </x-admin.modal>

    </x-slot>
</x-admin-app-layout>
