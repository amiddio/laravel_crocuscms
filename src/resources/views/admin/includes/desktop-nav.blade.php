<!-- Desktop Right buttons -->
<nav aria-label="Secondary" class="hidden space-x-2 md:flex md:items-center">

    <!-- Settings button -->
    <button
        @click="openSettingsPanel"
        class="p-2 transition-colors duration-200 rounded-full text-primary-lighter bg-primary-50 hover:text-primary hover:bg-primary-100 dark:hover:text-light dark:hover:bg-primary-dark dark:bg-dark focus:outline-none focus:bg-primary-100 dark:focus:bg-primary-dark focus:ring-primary-darker"
    >
        <span class="sr-only">Open settings panel</span>
        <svg
            class="w-7 h-7"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            aria-hidden="true"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"
            />
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
            />
        </svg>
    </button>

    <!-- User avatar button -->
    <div class="relative" x-data="{ open: false }">
        <button
            @click="open = !open; $nextTick(() => { if(open){ $refs.userMenu.focus() } })"
            type="button"
            aria-haspopup="true"
            :aria-expanded="open ? 'true' : 'false'"
            class="transition-opacity duration-200 rounded-full dark:opacity-75 dark:hover:opacity-100 focus:outline-none focus:ring dark:focus:opacity-100"
        >
            <span class="sr-only">User menu</span>
            <img class="w-12 h-12 rounded-full" src="{{ asset('admin/images/noavatar.jpg') }}" alt="" />
        </button>

        <!-- User dropdown menu -->
        <div
            x-show="open"
            x-ref="userMenu"
            x-transition:enter="transition-all transform ease-out"
            x-transition:enter-start="translate-y-1/2 opacity-0"
            x-transition:enter-end="translate-y-0 opacity-100"
            x-transition:leave="transition-all transform ease-in"
            x-transition:leave-start="translate-y-0 opacity-100"
            x-transition:leave-end="translate-y-1/2 opacity-0"
            @click.away="open = false"
            @keydown.escape="open = false"
            class="absolute right-0 w-48 py-1 bg-white rounded-md shadow-lg top-12 ring-1 ring-black ring-opacity-5 dark:bg-dark focus:outline-none"
            tabindex="-1"
            role="menu"
            aria-orientation="vertical"
            aria-label="User menu"
        >
            <a
                href="#"
                role="menuitem"
                class="block px-4 py-2 text-sm text-gray-700 transition-colors hover:bg-gray-100 dark:text-light dark:hover:bg-primary"
            >
                Your Profile
            </a>
            <a
                href="#"
                role="menuitem"
                class="block px-4 py-2 text-sm text-gray-700 transition-colors hover:bg-gray-100 dark:text-light dark:hover:bg-primary"
            >
                Settings
            </a>
            <a
                href="#"
                role="menuitem"
                class="block px-4 py-2 text-sm text-gray-700 transition-colors hover:bg-gray-100 dark:text-light dark:hover:bg-primary"
            >
                Logout
            </a>
        </div>
    </div>
</nav>
