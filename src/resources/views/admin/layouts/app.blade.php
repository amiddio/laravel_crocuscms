<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} :: {{ $page_title }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/css/admin-app.css'])
</head>

<body>
<div x-data="setup()" x-init="$refs.loading.classList.add('hidden'); setColors(color);" :class="{ 'dark': isDark}">
    <div class="flex h-screen antialiased text-gray-900 bg-gray-100 dark:bg-dark dark:text-light">

        <!-- Loading screen -->
        <div
            x-ref="loading"
            class="fixed inset-0 z-50 flex items-center justify-center text-2xl font-semibold text-white bg-primary-darker"
        >
            Loading.....
        </div>

        @include('admin.includes.sidebar')

        <div class="flex flex-col flex-1 min-h-screen overflow-x-hidden overflow-y-auto">
            <!-- Navbar -->
            <header class="relative flex-shrink-0 bg-white dark:bg-darker">
                <div class="flex items-center justify-between px-4 py-2 border-b dark:border-primary-darker">

                    @include('admin.includes.mobile-menu-button')

                    <!-- Brand -->
                    <a href="#" class="text-2xl font-bold tracking-wider text-primary-dark dark:text-light">
                        <img class="w-10 h-10 inline-block" src="{{ asset('admin/images/logo.png') }}" alt="{{ config('app.name') }}"/>
                        <span class="inline-block ml-2">{{ config('app.name') }}</span>
                    </a>

                    @include('admin.includes.mobile-sub-menu-button')
                    @include('admin.includes.desktop-nav')
                    @include('admin.includes.mobile-nav')

                </div>
            </header>

            <!-- Main content -->
            <div class="flex flex-1 h-full p-4">
                <main class="w-full">
                    <h1 class="text-3xl font-semibold">{{ $page_title }}</h1>
                    <hr class="h-px mt-4 mb-4 bg-gray-600 border-0 dark:bg-gray-700">
                    <div>
                        {{ $content }}
                    </div>
                </main>
            </div>

            <!-- Main footer -->
            <footer class="flex justify-center items-center p-4 bg-white border-t dark:bg-darker dark:border-primary-darker">
                <div class="text-gray-400 text-sm">{!! $copyright !!}</div>
            </footer>
        </div>

        @include('admin.includes.panel-settings')

    </div>
</div>

@include('admin.includes.alpine-setup-js')

@vite(['resources/js/app.js'])
</body>
</html>
