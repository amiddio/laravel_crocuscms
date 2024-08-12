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
{{--    <!-- Loading screen -->--}}
{{--    <div x-ref="loading" class="fixed inset-0 z-50 flex items-center justify-center text-2xl font-semibold text-white bg-primary-darker">--}}
{{--        Loading.....--}}
{{--    </div>--}}
    <div class="flex flex-col items-center justify-center min-h-screen p-4 space-y-4 antialiased text-gray-900 bg-gray-100 dark:bg-dark dark:text-light">
        <img class="w-20 h-20" src="{{ asset('admin/images/logo.png') }}" alt="{{ config('app.name') }}"/>
        <span class="inline-block mb-6 text-3xl font-bold tracking-wider uppercase text-primary-dark dark:text-light">
            {{ config('app.name') }}
        </span>
        <main>
            {{ $content }}
        </main>
    </div>
</div>
@vite(['resources/js/app.js'])
</body>
</html>
