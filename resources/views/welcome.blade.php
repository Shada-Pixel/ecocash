<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="font-sans antialiased h-screen max-h-screen bg-gradient-to-r from-gray-100 to-gray-300 dark:bg-gradient-to-r dark:from-black dark:to-gray-700 flex flex-col justify-between bg-cover bg-blend-multiply" >
    {{-- style="background-image: url('{{ asset('wall.png') }}');" --}}
    <!-- Page Heading -->
    <header class="">
        {{-- navigation --}}
        <nav x-data="{ open: false }" class="bg-transparent">
            <!-- Primary Navigation Menu -->
            <div class="max-w-7xl mx-auto px-4 sm:px-0">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="shrink-0 flex items-center">
                            <a href="{{ route('home') }}">
                                <x-application-logo
                                    class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                            </a>
                        </div>
                        @auth()
                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                                    {{ __('Admin Dashboard') }}
                                </x-nav-link>
                            </div>
                        @endauth
                    </div>

                    @auth()
                        <!-- Settings Dropdown -->
                        <div class="hidden sm:flex sm:items-center sm:ms-6">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                        <div>{{ Auth::user()->name }}</div>

                                        <div class="ms-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    {{-- dark mode toggler --}}
                                    <div
                                        class="w-full px-4 py-2 text-start text-sm leading-5 focus:outline-none flex justify-center gap-6">

                                        {{-- dark --}}
                                        <svg id="theme-toggle-dark-icon"
                                            class="w-5 h-5 text-gray-500 dark:text-gray-400 hover:text-blue-500 dark:hover:text-blue-300"
                                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z">
                                            </path>
                                        </svg>

                                        {{-- light --}}
                                        <svg id="theme-toggle-light-icon"
                                            class="w-5 h-5 text-gray-500 dark:text-gray-400 hover:text-orange-500 dark:hover:text-orange-300"
                                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                                fill-rule="evenodd" clip-rule="evenodd"></path>
                                        </svg>

                                        {{-- device --}}
                                        <svg id="theme-toggle-device-icon"
                                            class="w-5 h-5 text-gray-500 dark:text-gray-400 hover:text-orange-500 dark:hover:text-orange-300"
                                            fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25" />
                                        </svg>


                                    </div>

                                    <x-dropdown-link :href="route('profile.edit')">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                                this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    @else
                        <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
                            {{ __('Login') }}
                        </x-nav-link>
                    @endauth

                    <!-- Hamburger -->
                    <div class="-me-2 flex items-center sm:hidden">
                        <button @click="open = ! open"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Responsive Navigation Menu -->
            <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
                <div class="pt-2 pb-3 space-y-1">
                    <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-responsive-nav-link>
                </div>
                @auth()
                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                        <div class="px-4">
                            <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}
                            </div>
                            <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <x-responsive-nav-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-responsive-nav-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-responsive-nav-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-responsive-nav-link>
                            </form>
                        </div>
                    </div>
                @endauth
            </div>
        </nav>
    </header>

    <main class="flex flex-col-reverse sm:flex-row  flex-grow max-w-7xl mx-auto gap-20 items-center">

        <div class="p-4 sm:p-0">

            <h2 class="uppercase text-4xl sm:text-6xl text-gray-900 dark:text-gray-100">
                <span class=" bg-gray-400/40 inline-block p-2 rounded-lg mr-2">
                    {{-- Eco bricks logo svg --}}
                    <svg id="Layer_1" viewBox="0 0 998.23 788.07" class="w-10">
                        <defs>
                            <style>
                                .cls-1 {
                                    fill: #5bb225;
                                }

                                .cls-2 {
                                    fill: #fbc911;
                                }

                                .cls-3 {
                                    fill: #fd0101;
                                }
                            </style>
                        </defs>
                        <path class="cls-3"
                            d="m837.56,348.45c0-186.92-151.53-338.45-338.45-338.45S160.67,161.53,160.67,348.45c0,143.97,676.89,143.97,676.89,0Z" />
                        <path
                            d="m499.12,466.43c-89.56,0-173.16-9.72-235.41-27.37-34.16-9.69-61.02-21.56-79.84-35.28-22.02-16.06-33.19-34.67-33.19-55.32,0-47.04,9.21-92.67,27.39-135.64,17.55-41.49,42.67-78.76,74.67-110.76,32-32,69.26-57.12,110.75-74.67C406.44,9.21,452.07,0,499.11,0s92.67,9.21,135.63,27.39c41.49,17.55,78.76,42.67,110.76,74.67,32,32,57.12,69.26,74.67,110.76,18.17,42.96,27.39,88.6,27.39,135.64,0,20.65-11.17,39.26-33.19,55.32-18.82,13.73-45.68,25.6-79.84,35.28-62.25,17.65-145.85,27.37-235.41,27.37Zm0-446.43c-181.1,0-328.44,147.34-328.44,328.45,0,28.01,34.98,53.35,98.49,71.36,60.52,17.16,142.19,26.62,229.95,26.62s169.43-9.45,229.95-26.62c63.51-18.01,98.49-43.36,98.49-71.36,0-181.11-147.34-328.45-328.45-328.45Z" />
                        <g>
                            <path class="cls-1"
                                d="m204.35,282.88l-126.68,148.39v250.93h253.35v-250.93l-126.67-148.39h0Zm33.07,295.59h-66.17v-66.17h66.17v66.17Z" />
                            <path class="cls-2"
                                d="m498.66,283.02l-126.68,148.38v250.93h253.37v-250.93l-126.68-148.38h0Zm33.09,295.59h-66.17v-66.17h66.17v66.17Z" />
                            <path class="cls-1"
                                d="m792.99,283.02l-126.69,148.38v250.93h253.35v-250.93l-126.67-148.38h0Zm33.07,295.59h-66.17v-66.17h66.17v66.17Z" />
                        </g>
                        <path
                            d="m786.96,227.11l-134.19,157.17c-3.41,3.99-9.57,3.99-12.98,0l-134.19-157.17c-3.41-3.99-9.57-3.99-12.98,0l-134.13,157.1c-3.41,3.99-9.57,3.99-12.98,0l-134.22-157.24c-3.41-3.99-9.57-3.99-12.98,0L39.2,413.34c-1.32,1.54-2.04,3.51-2.04,5.54v295.31c0,4.71,3.82,8.53,8.53,8.53h285.78v.12h621.07c4.71,0,8.53-3.82,8.53-8.53v-295.31c0-2.03-.72-4-2.04-5.54l-159.09-186.36c-3.41-3.99-9.57-3.99-12.98,0h0Zm-455.48,454.67H78.12v-250.93l126.68-148.39,126.67,148.39v250.93h.01Zm294.33.12h-253.37v-250.93l126.68-148.38,126.68,148.38v250.93h.01Zm294.31,0h-253.35v-250.93l126.69-148.38,126.67,148.38v250.93h-.01Z" />
                        <path
                            d="m841.22,471.05h-95.56c-14.51,0-26.27,11.76-26.27,26.27v95.56c0,14.51,11.76,26.27,26.27,26.27h95.56c14.51,0,26.27-11.76,26.27-26.27v-95.56c0-14.51-11.76-26.27-26.27-26.27h0Zm-14.69,107.13h-66.17v-66.17h66.17v66.17Z" />
                        <path
                            d="m546.89,471.05h-95.54c-14.51,0-26.27,11.76-26.27,26.27v95.56c0,14.51,11.76,26.27,26.27,26.27h95.54c14.51,0,26.28-11.76,26.28-26.27v-95.56c0-14.51-11.78-26.27-26.28-26.27h0Zm-14.68,107.13h-66.17v-66.17h66.17v66.17Z" />
                        <path
                            d="m252.57,470.91h-95.56c-14.51,0-26.27,11.76-26.27,26.28v95.54c0,14.51,11.76,26.27,26.27,26.27h95.56c14.51,0,26.27-11.76,26.27-26.27v-95.54c0-14.52-11.76-26.28-26.27-26.28h0Zm-14.69,107.13h-66.17v-66.17h66.17v66.17Z" />
                        <path
                            d="m988.23,788.07h-.02l-978.23-1.47C4.46,786.59,0,782.11,0,776.58c0-5.52,4.48-9.99,10-9.99h.02l978.23,1.47c5.52,0,9.99,4.49,9.99,10.01,0,5.52-4.48,9.99-10,9.99Z" class=""/>
                    </svg>
                </span>ECO Bricks <br> Cash management <br> System
            </h2>


            <p class="text-gray-900 dark:text-gray-100 mt-24">A product of <a
                    href="https://shadapixel.sharebangladesh.org/" target="_blank">Shadapixel</a>
            </p>
            <div class="flex items-end">

                {{-- arrow svg --}}
                <svg width="28" height="63" viewBox="0 0 28 63" class="mb-[28px] mr-2">
                    <path
                        d="M1.99985 0.999999C1.99985 0.447714 1.55213 -1.09051e-06 0.999846 -1.11465e-06C0.447561 -1.13879e-06 -0.000154471 0.447714 -0.000154495 0.999999L1.99985 0.999999ZM27.2071 56.2071C27.5976 55.8166 27.5976 55.1834 27.2071 54.7929L20.8431 48.4289C20.4526 48.0384 19.8195 48.0384 19.4289 48.4289C19.0384 48.8195 19.0384 49.4526 19.4289 49.8431L25.0858 55.5L19.4289 61.1569C19.0384 61.5474 19.0384 62.1805 19.4289 62.5711C19.8195 62.9616 20.4526 62.9616 20.8431 62.5711L27.2071 56.2071ZM-0.000154495 0.999999L-0.00015644 45.5L1.99984 45.5L1.99985 0.999999L-0.000154495 0.999999ZM10.9998 56.5L26.5 56.5L26.5 54.5L10.9998 54.5L10.9998 56.5ZM-0.00015644 45.5C-0.000156706 51.5751 4.92471 56.5 10.9998 56.5L10.9998 54.5C6.02928 54.5 1.99984 50.4706 1.99984 45.5L-0.00015644 45.5Z"
                        class="fill-blue-950 dark:fill-white" />
                </svg>
                <span
                    class="mt-6 mb-4 px-6 py-2 rounded-full flex justify-between  items-center backdrop-blur-xl w-64 gap-6">
                    <img src="{{ asset('tech/laravel.svg') }}" alt="" srcset="" class="max-h-8">
                    <img src="{{ asset('tech/mysql2.svg') }}" alt="" srcset="" class="max-h-8">
                    <img src="{{ asset('tech/jquery.svg') }}" alt="" srcset="" class="max-h-8">
                    <img src="{{ asset('tech/tailwind.svg') }}" alt="" srcset="" class="max-h-8">
                </span>
            </div>

        </div>

        <div class="">

            <div class="flex">
                <span class=" bg-gray-400/40 p-2 rounded-lg mr-2 w-[150px] h-[150px]">
                    {{-- Eco bricks logo svg --}}
                    <svg id="Layer_1" viewBox="0 0 998.23 788.07" class="max-w-[150px]">
                        <defs>
                            <style>
                                .cls-1 {
                                    fill: #5bb225;
                                }

                                .cls-2 {
                                    fill: #fbc911;
                                }

                                .cls-3 {
                                    fill: #fd0101;
                                }
                            </style>
                        </defs>
                        <path class="cls-3"
                            d="m837.56,348.45c0-186.92-151.53-338.45-338.45-338.45S160.67,161.53,160.67,348.45c0,143.97,676.89,143.97,676.89,0Z" />
                        <path
                            d="m499.12,466.43c-89.56,0-173.16-9.72-235.41-27.37-34.16-9.69-61.02-21.56-79.84-35.28-22.02-16.06-33.19-34.67-33.19-55.32,0-47.04,9.21-92.67,27.39-135.64,17.55-41.49,42.67-78.76,74.67-110.76,32-32,69.26-57.12,110.75-74.67C406.44,9.21,452.07,0,499.11,0s92.67,9.21,135.63,27.39c41.49,17.55,78.76,42.67,110.76,74.67,32,32,57.12,69.26,74.67,110.76,18.17,42.96,27.39,88.6,27.39,135.64,0,20.65-11.17,39.26-33.19,55.32-18.82,13.73-45.68,25.6-79.84,35.28-62.25,17.65-145.85,27.37-235.41,27.37Zm0-446.43c-181.1,0-328.44,147.34-328.44,328.45,0,28.01,34.98,53.35,98.49,71.36,60.52,17.16,142.19,26.62,229.95,26.62s169.43-9.45,229.95-26.62c63.51-18.01,98.49-43.36,98.49-71.36,0-181.11-147.34-328.45-328.45-328.45Z" />
                        <g>
                            <path class="cls-1"
                                d="m204.35,282.88l-126.68,148.39v250.93h253.35v-250.93l-126.67-148.39h0Zm33.07,295.59h-66.17v-66.17h66.17v66.17Z" />
                            <path class="cls-2"
                                d="m498.66,283.02l-126.68,148.38v250.93h253.37v-250.93l-126.68-148.38h0Zm33.09,295.59h-66.17v-66.17h66.17v66.17Z" />
                            <path class="cls-1"
                                d="m792.99,283.02l-126.69,148.38v250.93h253.35v-250.93l-126.67-148.38h0Zm33.07,295.59h-66.17v-66.17h66.17v66.17Z" />
                        </g>
                        <path
                            d="m786.96,227.11l-134.19,157.17c-3.41,3.99-9.57,3.99-12.98,0l-134.19-157.17c-3.41-3.99-9.57-3.99-12.98,0l-134.13,157.1c-3.41,3.99-9.57,3.99-12.98,0l-134.22-157.24c-3.41-3.99-9.57-3.99-12.98,0L39.2,413.34c-1.32,1.54-2.04,3.51-2.04,5.54v295.31c0,4.71,3.82,8.53,8.53,8.53h285.78v.12h621.07c4.71,0,8.53-3.82,8.53-8.53v-295.31c0-2.03-.72-4-2.04-5.54l-159.09-186.36c-3.41-3.99-9.57-3.99-12.98,0h0Zm-455.48,454.67H78.12v-250.93l126.68-148.39,126.67,148.39v250.93h.01Zm294.33.12h-253.37v-250.93l126.68-148.38,126.68,148.38v250.93h.01Zm294.31,0h-253.35v-250.93l126.69-148.38,126.67,148.38v250.93h-.01Z" />
                        <path
                            d="m841.22,471.05h-95.56c-14.51,0-26.27,11.76-26.27,26.27v95.56c0,14.51,11.76,26.27,26.27,26.27h95.56c14.51,0,26.27-11.76,26.27-26.27v-95.56c0-14.51-11.76-26.27-26.27-26.27h0Zm-14.69,107.13h-66.17v-66.17h66.17v66.17Z" />
                        <path
                            d="m546.89,471.05h-95.54c-14.51,0-26.27,11.76-26.27,26.27v95.56c0,14.51,11.76,26.27,26.27,26.27h95.54c14.51,0,26.28-11.76,26.28-26.27v-95.56c0-14.51-11.78-26.27-26.28-26.27h0Zm-14.68,107.13h-66.17v-66.17h66.17v66.17Z" />
                        <path
                            d="m252.57,470.91h-95.56c-14.51,0-26.27,11.76-26.27,26.28v95.54c0,14.51,11.76,26.27,26.27,26.27h95.56c14.51,0,26.27-11.76,26.27-26.27v-95.54c0-14.52-11.76-26.28-26.27-26.28h0Zm-14.69,107.13h-66.17v-66.17h66.17v66.17Z" />
                        <path
                            d="m988.23,788.07h-.02l-978.23-1.47C4.46,786.59,0,782.11,0,776.58c0-5.52,4.48-9.99,10-9.99h.02l978.23,1.47c5.52,0,9.99,4.49,9.99,10.01,0,5.52-4.48,9.99-10,9.99Z" class=""/>
                    </svg>
                </span>
                {{-- arrow svg --}}
                <svg width="28" height="63" viewBox="0 0 28 63" class="mt-24 ml-2 rotate-180">
                    <path
                        d="M1.99985 0.999999C1.99985 0.447714 1.55213 -1.09051e-06 0.999846 -1.11465e-06C0.447561 -1.13879e-06 -0.000154471 0.447714 -0.000154495 0.999999L1.99985 0.999999ZM27.2071 56.2071C27.5976 55.8166 27.5976 55.1834 27.2071 54.7929L20.8431 48.4289C20.4526 48.0384 19.8195 48.0384 19.4289 48.4289C19.0384 48.8195 19.0384 49.4526 19.4289 49.8431L25.0858 55.5L19.4289 61.1569C19.0384 61.5474 19.0384 62.1805 19.4289 62.5711C19.8195 62.9616 20.4526 62.9616 20.8431 62.5711L27.2071 56.2071ZM-0.000154495 0.999999L-0.00015644 45.5L1.99984 45.5L1.99985 0.999999L-0.000154495 0.999999ZM10.9998 56.5L26.5 56.5L26.5 54.5L10.9998 54.5L10.9998 56.5ZM-0.00015644 45.5C-0.000156706 51.5751 4.92471 56.5 10.9998 56.5L10.9998 54.5C6.02928 54.5 1.99984 50.4706 1.99984 45.5L-0.00015644 45.5Z"
                        class="fill-blue-950 dark:fill-white" />
                </svg>
            </div>
            <div class="flex pl-8">
                {{-- arrow svg --}}
                <svg width="28" height="63" viewBox="0 0 28 63" class="mr-2">
                    <path
                        d="M1.99985 0.999999C1.99985 0.447714 1.55213 -1.09051e-06 0.999846 -1.11465e-06C0.447561 -1.13879e-06 -0.000154471 0.447714 -0.000154495 0.999999L1.99985 0.999999ZM27.2071 56.2071C27.5976 55.8166 27.5976 55.1834 27.2071 54.7929L20.8431 48.4289C20.4526 48.0384 19.8195 48.0384 19.4289 48.4289C19.0384 48.8195 19.0384 49.4526 19.4289 49.8431L25.0858 55.5L19.4289 61.1569C19.0384 61.5474 19.0384 62.1805 19.4289 62.5711C19.8195 62.9616 20.4526 62.9616 20.8431 62.5711L27.2071 56.2071ZM-0.000154495 0.999999L-0.00015644 45.5L1.99984 45.5L1.99985 0.999999L-0.000154495 0.999999ZM10.9998 56.5L26.5 56.5L26.5 54.5L10.9998 54.5L10.9998 56.5ZM-0.00015644 45.5C-0.000156706 51.5751 4.92471 56.5 10.9998 56.5L10.9998 54.5C6.02928 54.5 1.99984 50.4706 1.99984 45.5L-0.00015644 45.5Z"
                        class="fill-blue-950 dark:fill-white" />
                </svg>
                <div class="m-1 w-[25vw] aspect-video rounded-lg bg-cover" >
                    <img src="{{asset('dashboard.png')}}" alt="" srcset="" class="hidden dark:block rounded-lg">
                    <img src="{{asset('dashboardw.png')}}" alt="" srcset="" class="block dark:hidden rounded-lg">
                </div>
            </div>

        </div>


    </main>

    <footer class="text-center sm:text-right w-full p-4 text-gray-800 dark:text-gray-200">
        <p>Developed by <a href="https://shadapixel.sharebangladesh.org/" target="_blank"><span class="font-medium text-2xl ml-4">shada<span class="bg-teal-500 m-0 p-0">pix</span>el</span></a></p>
    </footer>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
</body>

</html>
