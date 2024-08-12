<x-admin-guest-layout>
    <x-slot name="page_title">{{ __('Login') }}</x-slot>

    <x-slot name="content">
        <div class="w-full max-w-sm px-4 py-6 space-y-6 bg-white rounded-md dark:bg-darker">
            <h1 class="text-xl font-semibold text-center">{{ __('Login') }}</h1>
            <form method="post" action="{{ route('admin.login') }}" class="space-y-6">
                @csrf

                <div>
                    <input
                        class="w-full px-4 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker"
                        type="text"
                        name="login"
                        placeholder="{{ __('Login') }}"
                        value="{{ old('login') }}"
                        required
                    />
                    <x-admin.input-error :messages="$errors->get('login')"/>
                </div>

                <div>
                    <input
                        class="w-full px-4 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker"
                        type="password"
                        name="password"
                        placeholder="{{ __('Password') }}"
                        required
                    />
                    <x-admin.input-error :messages="$errors->get('password')"/>
                </div>

                <div class="flex items-center justify-between">
                    <!-- Remember me toggle -->
                    <label class="flex items-center">
                        <div class="relative inline-flex items-center">
                            <input type="hidden" name="remember" value="0" />
                            <input
                                type="checkbox"
                                name="remember"
                                value="1"
                                @if(old('remember')) checked @endif
                                class="w-10 h-4 transition bg-gray-200 border-none rounded-full shadow-inner outline-none appearance-none toggle checked:bg-primary-light disabled:bg-gray-200 focus:outline-none"
                            />
                            <span
                                class="absolute top-0 left-0 w-4 h-4 transition-all transform scale-150 bg-white rounded-full shadow-sm"
                            ></span>
                        </div>
                        <span class="ml-3 text-sm font-normal text-gray-500 dark:text-gray-400">{{ __('Remember me') }}</span>
                    </label>
                </div>

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
