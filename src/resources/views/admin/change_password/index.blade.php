<x-admin-app-layout>
    <x-slot name="page_title">{{ __('Change Password') }}</x-slot>

    <x-slot name="content">

        <form method="post" action="{{ route('admin.change_password') }}">
            @csrf
            <x-admin.input-row type="password" :name="'current_password'" :label="'Current Password'" :required="true" autofocus />
            <x-admin.input-row type="password" :name="'password'" :label="'New Password'" :required="true" />
            <x-admin.input-row type="password" :name="'password_confirmation'" :label="'Confirm Password'" :required="true" />
            <x-admin.button-primary :label="__('Save')"/>
        </form>

    </x-slot>
</x-admin-app-layout>
