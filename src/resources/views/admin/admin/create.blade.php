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
            <div class="mb-6">
                <label for="roles" class="block mb-2 text-gray-900 dark:text-white">{{ __('Select a role') }} <span class="text-red-800">*</span></label>
                <select id="roles" name="admin_role_id" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="0">---</option>
                    @foreach($roles as $id=>$name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
                <x-admin.input-error :messages="$errors->get('admin_role_id')"/>
            </div>
            <x-admin.checkbox :name="'is_active'" :label="__('Is active?')" :checked="true" />
            <x-admin.button-primary :label="__('Create')"/>
        </form>

    </x-slot>
</x-admin-app-layout>
