<x-admin-app-layout>
    <x-slot name="page_title">{{ __('Versions') }}</x-slot>

    <x-slot name="content">

        <table class="min-w-full text-left text-sm whitespace-nowrap">
            <tbody>
                <tr class="border-b dark:border-neutral-600">
                    <th scope="row" class="px-6 py-4 w-1/3">PHP</th>
                    <td class="px-6 py-4 w-2/3 ">v{{ PHP_VERSION }}</td>
                </tr>
                <tr class="border-b dark:border-neutral-600">
                    <th scope="row" class="px-6 py-4">Laravel</th>
                    <td class="px-6 py-4">v{{ Illuminate\Foundation\Application::VERSION }}</td>
                </tr>
                <tr class="border-b dark:border-neutral-600">
                    <th scope="row" class="px-6 py-4">Node.js</th>
                    <td class="px-6 py-4">{{ $nodejsVersion }}</td>
                </tr>
                <tr class="dark:border-neutral-600">
                    <th scope="row" class="px-6 py-4">Npm</th>
                    <td class="px-6 py-4">v{{ $npmVersion }}</td>
                </tr>
            </tbody>
        </table>

    </x-slot>
</x-admin-app-layout>
