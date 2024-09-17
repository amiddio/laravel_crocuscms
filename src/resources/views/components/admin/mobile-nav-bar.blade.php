<!-- Mobile sub menu -->
<nav
    x-transition:enter="transition duration-200 ease-in-out transform sm:duration-500"
    x-transition:enter-start="-translate-y-full opacity-0"
    x-transition:enter-end="translate-y-0 opacity-100"
    x-transition:leave="transition duration-300 ease-in-out transform sm:duration-500"
    x-transition:leave-start="translate-y-0 opacity-100"
    x-transition:leave-end="-translate-y-full opacity-0"
    x-show="isMobileSubMenuOpen"
    @click.away="isMobileSubMenuOpen = false"
    class="absolute flex items-center p-4 bg-white rounded-md shadow-lg dark:bg-darker top-16 inset-x-4 md:hidden"
    aria-label="Secondary"
>
    <div>
        @include('admin.includes.admin-sub-menu')
    </div>
</nav>
</div>

<!-- Mobile main manu -->
<div
    class="border-b md:hidden dark:border-primary-darker"
    x-show="isMobileMainMenuOpen"
    @click.away="isMobileMainMenuOpen = false"
>
    <nav aria-label="Main" class="px-2 py-4 space-y-2">

        @foreach($items as $key => $item)

            <div @isset($item['items']) {!! $item['is_active'] ? 'x-data="{ isActive: true, open: true}"' : 'x-data="{ isActive: false, open: false }"' !!} @endisset>
                <!-- active & hover classes 'bg-primary-100 dark:bg-primary' -->
                <a
                    @isset($item['route']) href="{{ route($item['route']) }}" @else href="#" @endisset
                @click="$event.preventDefault(); open = !open"
                    class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                    :class="{'bg-primary-100 dark:bg-primary': isActive || open}"
                    role="button"
                    aria-haspopup="true"
                    :aria-expanded="(open || isActive) ? 'true' : 'false'"
                >
                    <span aria-hidden="true">
                      <svg
                          class="w-5 h-5"
                          xmlns="http://www.w3.org/2000/svg"
                          fill="none"
                          viewBox="0 0 24 24"
                          stroke="currentColor"
                      >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="{{ $item['icon'] }}"
                        />
                      </svg>
                    </span>
                    <span class="ml-2 text-sm">{{ __($item['name']) }}</span>
                    @isset($item['items'])
                        <span class="ml-auto" aria-hidden="true">
                          <!-- active class 'rotate-180' -->
                          <svg
                              class="w-4 h-4 transition-transform transform"
                              :class="{ 'rotate-180': open }"
                              xmlns="http://www.w3.org/2000/svg"
                              fill="none"
                              viewBox="0 0 24 24"
                              stroke="currentColor"
                          >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                          </svg>
                        </span>
                    @endisset
                </a>
                @isset($item['items'])
                    <div role="menu" x-show="open" class="mt-2 space-y-2 px-7" aria-label="{{ __($item['name']) }}">
                        @foreach($item['items'] as $subItem)
                        <a
                            href="{{ route($subItem['route']) }}"
                            role="menuitem"
                            class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:text-gray-400 dark:hover:text-light hover:text-gray-700"
                        >
                            {{ __($subItem['name']) }}
                        </a>
                        @endforeach
                    </div>
                @endisset
            @endforeach
            </div>
    </nav>
