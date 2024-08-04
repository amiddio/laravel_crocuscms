<x-admin-guest-layout>
    <x-slot name="page_title">{{ __('Login') }}</x-slot>

    <x-slot name="content">
        <div class="w-full max-w-sm px-4 py-6 space-y-6 bg-white rounded-md dark:bg-darker">
            <h1 class="text-xl font-semibold text-center">{{ __('Login') }}</h1>
            <form method="post" action="" class="space-y-6">
                @csrf
                <input
                    class="w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker"
                    type="text"
                    name="login"
                    placeholder="{{ __('Login') }}"
                    required
                />
                <input
                    class="w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker"
                    type="password"
                    name="password"
                    placeholder="{{ __('Password') }}"
                    required
                />
                <div>
                    <button
                        type="submit"
                        class="w-full px-4 py-2 font-medium text-center text-white transition-colors duration-200 rounded-md bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-1 dark:focus:ring-offset-darker"
                    >
                        {{ __('Login') }}
                    </button>
                </div>
            </form>
        </div>
    </x-slot>
</x-admin-guest-layout>
