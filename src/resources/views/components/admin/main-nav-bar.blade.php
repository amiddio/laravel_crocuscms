<!-- Sidebar -->
<aside class="flex-shrink-0 hidden w-64 bg-white border-r dark:border-primary-darker dark:bg-darker md:block">
    <div class="flex flex-col h-full">
        <!-- Sidebar links -->
        <nav aria-label="Main" class="flex-1 px-2 py-4 space-y-2 overflow-y-hidden hover:overflow-y-auto">

            @foreach($items as $key => $item)

                <div @isset($item['items']) {!! request()->route()->named($item['child_routes']) ? 'x-data="{ isActive: true, open: true }"' : 'x-data="{ isActive: false, open: false }"' !!} @endisset>
                    {{--                <!-- active classes 'bg-primary-100 dark:bg-primary' -->--}}
                    {{--                <!-- active & hover classes 'text-gray-700 dark:text-light' -->--}}
                    {{--                <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->--}}
                    <a
                        @isset($item['route']) href="{{ route($item['route']) }}" @else href="#" @endisset
                        class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary
                        @isset($item['route'])
                        {{ request()->route()->named($item['route']) ? 'bg-primary-100 dark:bg-primary' : '' }}
                        @endisset
                        "
                        role="button"
                        aria-haspopup="true"
                        @isset($item['items'])
                        @click="$event.preventDefault(); open = !open"
                        :class="{ 'bg-primary-100 dark:bg-primary': isActive || open }"
                        :aria-expanded="(open || isActive) ? 'true' : 'false'"
                        @endisset
                    >
                        <span aria-hidden="true">
                            <svg
                                class="w-6 h-6"
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
                        <span aria-hidden="true" class="ml-auto">
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
                    <div x-show="open" class="mt-2 space-y-2 px-7" role="menu" arial-label="{{ __($item['name']) }}">
                        @foreach($item['items'] as $subItem)
                        <a
                            href="{{ route($subItem['route']) }}"
                            role="menuitem"
                            class="block p-2 text-sm {{ request()->route()->named($subItem['route']) ? 'text-gray-700 dark:text-light' : 'text-gray-400 dark:text-gray-400' }} transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700"
                        >
                            {{ __($subItem['name']) }}
                        </a>
                        @endforeach
                    </div>
                    @endisset
                </div>
            @endforeach
        </nav>
    </div>
</aside>
