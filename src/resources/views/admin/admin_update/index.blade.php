<x-admin-app-layout>
    <x-slot name="page_title">{{ __('Admin Update') }}</x-slot>

    <x-slot name="content">

        <form method="post" action="{{ route('admin.admin_update') }}" enctype="multipart/form-data">
            @csrf
            <x-admin.input-row type="text" :name="'name'" :label="'Name'" :value="old('name', $admin->name)" autofocus />
            @empty($admin->avatar)
                <x-admin.input-row type="file" :name="'avatar'" :label="'Avatar'" />
            @else
                <div class="col-span-full mb-6">
                    <div class="flex items-center gap-x-3">
                        <img src="{{ Storage::url(config('custom.path.admin_avatar') . '/' . $admin->avatar) }}" class="h-12 w-12 text-gray-300" viewBox="0 0 24 24" />
                        <button
                            type="button"
                            class="inline-block rounded bg-danger px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-danger-3 transition duration-150 ease-in-out hover:bg-danger-accent-300 hover:shadow-danger-2 focus:bg-danger-accent-300 focus:shadow-danger-2 focus:outline-none focus:ring-0 active:bg-danger-600 active:shadow-danger-2 motion-reduce:transition-none dark:shadow-black/30 dark:hover:shadow-dark-strong dark:focus:shadow-dark-strong dark:active:shadow-dark-strong"
                            data-twe-toggle="modal"
                            data-twe-target="#deleteAvatar"
                            data-twe-ripple-init
                            data-twe-ripple-color="light">
                            {{ __('Delete avatar') }}
                        </button>
                    </div>
                </div>
            @endempty
            <x-admin.button-primary :label="__('Save')"/>
        </form>

        <x-admin.modal :id="'deleteAvatar'" :title="__('Delete Avatar')" :button="'Delete'">
            <form method="post" action="{{ route('admin.admin_update') }}" id="deleteAvatar-form">
                @csrf
                @method('delete')
                <input type="hidden" name="delete_avatar" value="1" />
                <p>
                    {{ __('Are you sure you want to delete avatar?') }}
                </p>
            </form>
        </x-admin.modal>

    </x-slot>
</x-admin-app-layout>
