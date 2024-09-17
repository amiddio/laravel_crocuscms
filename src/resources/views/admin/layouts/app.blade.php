<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} :: {{ $page_title }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/css/tw-elements.min.css"/>

    @vite(['resources/css/app.css', 'resources/css/admin-app.css'])
</head>

<body>
<div x-data="setup()" x-init="$refs.loading.classList.add('hidden'); setColors(color);">
    <div class="flex h-screen antialiased text-gray-900 bg-gray-100 dark:bg-dark dark:text-light">

        <x-admin-desktop-nav-bar/>

        <div class="flex flex-col flex-1 min-h-screen overflow-x-hidden overflow-y-auto">
            <!-- Navbar -->
            <header class="relative flex-shrink-0 bg-white dark:bg-darker">
                <div class="flex items-center justify-between px-4 py-2 border-b dark:border-primary-darker">

                    @include('admin.includes.mobile-menu-button')

                    <!-- Brand -->
                    <a href="#" class="text-2xl font-bold tracking-wider text-primary-dark dark:text-light">
                        <img class="w-10 h-10 inline-block" src="{{ asset('admin/images/logo.png') }}"
                             alt="{{ config('app.name') }}"/>
                        <span class="inline-block ml-2">{{ config('app.name') }}</span>
                    </a>

                    @include('admin.includes.mobile-sub-menu-button')
                    @include('admin.includes.desktop-nav')
                    <x-admin-mobile-nav-bar/>

                </div>
            </header>

            <div class="flex w-full p-4">
                <h1 class="text-3xl font-semibold">{{ $page_title }}</h1>
            </div>
            <div class="w-full h-full p-4" style="max-width: 1024px;">
                <main>
                    <div class="rounded-md overflow-hidden shadow-lg p-4 bg-white">
                        <x-admin.alert/>
                        {{ $content }}
                    </div>
                </main>
            </div>

            {{--            <!-- Main footer -->--}}
            {{--            <footer class="flex justify-center items-center p-4 bg-white border-t dark:bg-darker dark:border-primary-darker">--}}
            {{--                <div class="text-gray-400 text-sm">{!! $copyright !!}</div>--}}
            {{--            </footer>--}}
        </div>

    </div>
</div>

@include('admin.includes.alpine-setup-js')

@vite(['resources/js/app.js'])
<script src="https://cdn.jsdelivr.net/npm/tw-elements/js/tw-elements.umd.min.js"></script>
</body>
</html>
