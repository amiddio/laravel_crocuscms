<x-admin-app-layout>
    <x-slot name="page_title">{{ __('Delete Account') }}</x-slot>

    <x-slot name="content">

        <p class="text-left mb-6">
            {{ __('On this page you can delete your account. All your data and settings will be permanently delete.') }}
        </p>

        <div>
            <button
                type="button"
                class="inline-block rounded bg-danger px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-danger-3 transition duration-150 ease-in-out hover:bg-danger-accent-300 hover:shadow-danger-2 focus:bg-danger-accent-300 focus:shadow-danger-2 focus:outline-none focus:ring-0 active:bg-danger-600 active:shadow-danger-2 motion-reduce:transition-none dark:shadow-black/30 dark:hover:shadow-dark-strong dark:focus:shadow-dark-strong dark:active:shadow-dark-strong"
                data-twe-toggle="modal"
                data-twe-target="#deleteAccount"
                data-twe-ripple-init
                data-twe-ripple-color="light">
                {{ __('Delete Account') }}
            </button>
        </div>
        <x-admin.modal :id="'deleteAccount'" :title="__('Delete Account')" :button="'Delete'">
            <form method="post" action="{{ route('admin.delete_account') }}" id="deleteAccount-form">
                @csrf
                @method('delete')
                <p>
                    {{ __('Are you sure you want to delete this account?') }}
                </p>
            </form>
        </x-admin.modal>

    </x-slot>
</x-admin-app-layout>
