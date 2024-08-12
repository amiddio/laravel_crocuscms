<a
    href="{{ route('admin.admin_update') }}"
    role="menuitem"
    class="block px-4 py-2 text-sm text-gray-700 transition-colors hover:bg-gray-100 dark:text-light dark:hover:bg-primary"
>
    {{ __('Admin Update') }}
</a>
<a
    href="{{ route('admin.change_password') }}"
    role="menuitem"
    class="block px-4 py-2 text-sm text-gray-700 transition-colors hover:bg-gray-100 dark:text-light dark:hover:bg-primary"
>
    {{ __('Change Password') }}
</a>
<a
    href="{{ route('admin.delete_account') }}"
    role="menuitem"
    class="block px-4 py-2 text-sm text-gray-700 transition-colors hover:bg-gray-100 dark:text-light dark:hover:bg-primary"
>
    {{ __('Delete Account') }}
</a>
<hr class="my-1"/>
<form method="post" action="{{ route('admin.logout') }}" class="flex justify-center my-4">
    @csrf
    <button
        type="submit"
        class="inline-block justify-center rounded bg-primary px-4 pb-[5px] pt-[6px] text-xs font-medium uppercase leading-normal text-white shadow-primary-3 transition duration-150 ease-in-out hover:bg-primary-accent-300 hover:shadow-primary-2 focus:bg-primary-accent-300 focus:shadow-primary-2 focus:outline-none focus:ring-0 active:bg-primary-600 active:shadow-primary-2 motion-reduce:transition-none dark:shadow-black/30 dark:hover:shadow-dark-strong dark:focus:shadow-dark-strong dark:active:shadow-dark-strong">
        {{ __('Logout') }}
    </button>
</form>
