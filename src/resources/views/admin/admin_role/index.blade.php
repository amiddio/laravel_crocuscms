<x-admin-app-layout>
    <x-slot name="page_title">{{ __('Admin Roles List') }}</x-slot>

    <x-slot name="content">

        <div class="text-right space-x-4">
            <a
                href="{{ route('admin.admin_roles.create') }}"
                class="text-primary transition duration-150 ease-in-out hover:text-primary-600 focus:text-primary-600 active:text-primary-700 dark:text-primary-400 dark:hover:text-primary-500 dark:focus:text-primary-500 dark:active:text-primary-600"
            >{{ __('Create') }}</a>
        </div>
        <hr class="mt-3 mb-6" />

        @if($roles->count() > 0)
            <div class="overflow-x-auto bg-white dark:bg-neutral-700">

                <!-- Table -->
                <table class="min-w-full text-left text-sm whitespace-nowrap">

                    <!-- Table head -->
                    <thead class="uppercase tracking-wider border-b-2 dark:border-neutral-600">
                    <tr>
                        <th scope="col" class="px-6 py-4">
                            {{ __('#Id') }}
                        </th>
                        <th scope="col" class="px-6 py-4">
                            {{ __('Name') }}
                        </th>
                        <th scope="col" class="px-6 py-4">
                            {{ __('Actions') }}
                        </th>
                    </tr>
                    </thead>

                    <!-- Table body -->
                    <tbody>
                    @foreach($roles as $role)
                        <tr class="border-b dark:border-neutral-600">
                            <th scope="row" class="px-6 py-4">{{ $role->id }}</th>
                            <td class="px-6 py-4">{{ $role->name }}</td>
                            <td class="px-6 py-4 space-x-4">
                                @if($role->name != config('admin.super_admin_role_name'))
                                <a
                                    href="{{ route('admin.admin_roles.edit', $role->id) }}"
                                    class="text-warning transition duration-150 ease-in-out hover:text-warning-600 focus:text-warning-600 active:text-warning-700"
                                >{{ __('Edit') }}</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p>{{ __('Roles not found') }}</p>
        @endif

    </x-slot>
</x-admin-app-layout>
