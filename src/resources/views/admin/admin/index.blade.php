<x-admin-app-layout>
    <x-slot name="page_title">{{ __('Admin List') }}</x-slot>

    <x-slot name="content">

        <div class="text-right space-x-4">
            <a
                href="{{ url()->previous() }}"
                class="text-secondary transition duration-150 ease-in-out hover:text-secondary-600 focus:text-secondary-600 active:text-secondary-700"
            >{{ __('Back') }}</a>
            <a
                href="{{ route('admin.admins.create') }}"
                class="text-primary transition duration-150 ease-in-out hover:text-primary-600 focus:text-primary-600 active:text-primary-700 dark:text-primary-400 dark:hover:text-primary-500 dark:focus:text-primary-500 dark:active:text-primary-600"
            >{{ __('Create') }}</a>
        </div>
        <hr class="mt-3 mb-6" />

        @if($admins)
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
                            {{ __('Login') }}
                        </th>
                        <th scope="col" class="px-6 py-4">
                            {{ __('Is Active?') }}
                        </th>
                        <th scope="col" class="px-6 py-4">
                            {{ __('Actions') }}
                        </th>
                    </tr>
                    </thead>

                    <!-- Table body -->
                    <tbody>
                    @foreach($admins as $admin)
                    <tr class="border-b dark:border-neutral-600">
                        <th scope="row" class="px-6 py-4">{{ $admin->id }}</th>
                        <td class="px-6 py-4">{{ $admin->name }}</td>
                        <td class="px-6 py-4">{{ $admin->login }}</td>
                        <td class="px-6 py-4">
                            <x-admin.is-active :value="$admin->is_active" />
                        </td>
                        <td class="px-6 py-4 space-x-4">
                            <a
                                href="{{ route('admin.admins.show', $admin->id) }}"
                                class="text-info transition duration-150 ease-in-out hover:text-info-600 focus:text-info-600 active:text-info-700"
                            >{{ __('Show') }}</a>
                            <a
                                href="{{ route('admin.admins.edit', $admin->id) }}"
                                class="text-warning transition duration-150 ease-in-out hover:text-warning-600 focus:text-warning-600 active:text-warning-700"
                            >{{ __('Edit') }}</a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>

                </table>

            </div>
        @endif

    </x-slot>
</x-admin-app-layout>
