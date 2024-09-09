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
                href="{{ route('admin.admins.edit', $admin->id) }}"
                class="text-warning transition duration-150 ease-in-out hover:text-warning-600 focus:text-warning-600 active:text-warning-700"
            >{{ __('Edit') }}</a>
            <a
                href="{{ route('admin.admins.create') }}"
                class="text-primary transition duration-150 ease-in-out hover:text-primary-600 focus:text-primary-600 active:text-primary-700 dark:text-primary-400 dark:hover:text-primary-500 dark:focus:text-primary-500 dark:active:text-primary-600"
            >{{ __('Create') }}</a>
            <a
                href="#"
                class="text-danger transition duration-150 ease-in-out hover:text-danger-600 focus:text-danger-600 active:text-danger-700"
                data-twe-toggle="modal"
                data-twe-target="#deleteAdmin"
            >{{ __('Delete') }}</a>
        </div>
        <hr class="mt-3 mb-6" />

        <div class="overflow-x-auto bg-white dark:bg-neutral-700">
            <!-- Table -->
            <table class="min-w-full text-left text-sm whitespace-nowrap">
                <!-- Table body -->
                <tbody>
                    <tr class="border-b dark:border-neutral-600">
                        <th scope="row" class="px-6 py-4 w-1/4 text-base">{{ __('Id') }}</th>
                        <td class="px-6 py-4 w-3/4 text-base">{{ $admin->id }}</td>
                    </tr>
                    <tr class="border-b dark:border-neutral-600">
                        <th scope="row" class="px-6 py-4">{{ __('Role') }}</th>
                        <td class="px-6 py-4">@if($admin->role) {{ $admin->role->name }} @endif</td>
                    </tr>
                    <tr class="border-b dark:border-neutral-600">
                        <th scope="row" class="px-6 py-4">{{ __('Login') }}</th>
                        <td class="px-6 py-4">{{ $admin->login }}</td>
                    </tr>
                    <tr class="border-b dark:border-neutral-600">
                        <th scope="row" class="px-6 py-4">{{ __('Name') }}</th>
                        <td class="px-6 py-4">{{ $admin->name }}</td>
                    </tr>
                    @if($admin->avatar)
                        <tr class="border-b dark:border-neutral-600">
                            <th scope="row" class="px-6 py-4">{{ __('Avatar') }}</th>
                            <td class="px-6 py-4">
                                <img src="{{ Storage::url(config('admin.path.admin_avatar') . '/' . $admin->avatar) }}" alt="{{ $admin->login }}" class="w-12 h-12 rounded-full" />
                            </td>
                        </tr>
                    @endif
                    <tr class="border-b dark:border-neutral-600">
                        <th scope="row" class="px-6 py-4">{{ __('Is Active?') }}</th>
                        <td class="px-6 py-4"><x-admin.is-active :value="$admin->is_active" /></td>
                    </tr>
                    <tr class="border-b dark:border-neutral-600">
                        <th scope="row" class="px-6 py-4">{{ __('Registered') }}</th>
                        <td class="px-6 py-4">{{ $admin->created_at }}</td>
                    </tr>
                    <tr class="border-b dark:border-neutral-600">
                        <th scope="row" class="px-6 py-4">{{ __('Updated') }}</th>
                        <td class="px-6 py-4">{{ $admin->updated_at }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

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
