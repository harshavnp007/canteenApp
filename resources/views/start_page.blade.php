<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{config('app.name')}}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="{{secure_asset('css/app.css')}}">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body class="antialiased">

<!-- Section 1 -->
<section class="w-full px-3 h-screen antialiased bg-indigo-600 lg:px-6" style="background: url('{{secure_asset('assets/images/home.png')}}');background-size: cover;background-repeat: no-repeat;background-position: center">
    <div class="mx-auto max-w-7xl">
        <nav class="absolute px-6 top-0 left-0 w-full z-50 h-20 mx-auto" x-data="{ showMenu: false }">
            <div class="container max-w-7xl relative flex flex-wrap items-center justify-between h-20 mx-auto font-medium sm:px-4 md:px-2">
                <a href="#" class="py-4 pl-0 pr-4 md:pl-4 md:py-0">
                    <span class="text-2xl mb-5 sm:text-3xl font-black leading-none text-white select-none logo">DS BOJANA <span class="text-red-600">.</span></span>
                </a>
                <div class="top-0 left-0 w-full flex-1 items-start h-full p-4 text-sm bg-gray-900 bg-opacity-50 md:absolute lg:text-base md:h-auto md:bg-transparent md:p-0 md:relative md:flex hidden " :class="{'flex fixed': showMenu, 'hidden': !showMenu }">
                    <div class="flex-col w-full h-auto overflow-hidden bg-white rounded-lg select-none md:bg-transparent md:rounded-none md:relative md:flex md:flex-row md:overflow-auto justify-end">
                        <a href="#" class="inline-flex items-center block w-auto h-16 px-6 text-xl font-black leading-none text-gray-900 select-none md:hidden">ArtWorksIT<span class="text-red-600">.</span></a>
                        <div class="flex flex-col items-start justify-end w-full pt-4 md:items-center md:w-1/2 md:flex-row md:py-5">
                            <span class="relative shadow-lg md:shadow-none inline-flex w-full md:rounded-full md:w-auto">
                                <a href="{{secure_url('login')}}" class="inline-flex items-center w-full px-6 py-3 text-lg font-semibold leading-4 text-white transition duration-150 ease-in-out md:bg-transparent bg-red-600 border border-transparent md:px-3 md:w-auto md:rounded-full lg:px-5 md:hover:bg-transparent hover:bg-red-500 focus:outline-none md:focus:border-transparent focus:border-red-700 md:active:bg-transparent active:bg-red-700 dark:bg-red-800 dark:text-gray-300">
                                    Login
                                </a>
                            </span>
                            <span class="relative shadow-lg md:shadow-none inline-flex w-full md:rounded-full md:w-auto">
                                <a href="{{secure_url('register')}}" class="inline-flex items-center w-full px-6 py-3 text-lg font-semibold leading-4 text-white transition duration-150 ease-in-out md:bg-transparent bg-red-600 border border-transparent md:px-3 md:w-auto md:rounded-full lg:px-5 md:hover:bg-transparent hover:bg-red-500 focus:outline-none md:focus:border-transparent focus:border-red-700 md:active:bg-transparent active:bg-red-700 dark:bg-red-800 dark:text-gray-300">
                                    Register
                                </a>
                            </span>
                            <span class="relative shadow-lg md:shadow-none inline-flex w-full md:rounded-full md:w-auto">
                                <a href="{{secure_url('register')}}" class="inline-flex items-center w-full px-6 py-3 text-lg font-semibold leading-4 text-white transition duration-150 ease-in-out md:bg-transparent bg-red-600 border border-transparent md:px-3 md:w-auto md:rounded-full lg:px-5 md:hover:bg-transparent hover:bg-red-500 focus:outline-none md:focus:border-transparent focus:border-red-700 md:active:bg-transparent active:bg-red-700 dark:bg-red-800 dark:text-gray-300">
                                    Meals
                                </a>
                            </span>
                            <span class="relative shadow-lg md:shadow-none inline-flex w-full md:rounded-full md:w-auto">
                                <a href="{{secure_url('register')}}" class="inline-flex items-center w-full px-6 py-3 text-lg font-semibold leading-4 text-white transition duration-150 ease-in-out md:bg-transparent bg-red-600 border border-transparent md:px-3 md:w-auto md:rounded-full lg:px-5 md:hover:bg-transparent hover:bg-red-500 focus:outline-none md:focus:border-transparent focus:border-red-700 md:active:bg-transparent active:bg-red-700 dark:bg-red-800 dark:text-gray-300">
                                    Contact Us
                                </a>
                            </span>
                        </div>
                    </div>
                </div>
                <div @click="showMenu = !showMenu" class="absolute right-0 flex flex-col items-center items-end justify-center w-10 h-10 rounded-full cursor-pointer md:hidden hover:bg-gray-100">
                    <svg class="w-6 h-6 text-gray-700" x-show="!showMenu" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg class="w-6 h-6 text-gray-700" x-show="showMenu" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </div>
            </div>
        </nav>
        <div class="container py-32 flex items-center justify-center mx-auto text-center sm:px-4 h-screen">
            <h1 class="text-4xl font-extrabold leading-10 tracking-tight text-white sm:text-5xl sm:leading-none md:text-6xl xl:text-7xl">
                <span class="block">
                    <span class="block mb-10">College Canteen</span>
                </span>
            </h1>
        </div>
    </div>
</section>
<script src="{{ mix('js/app.js') }}" ></script>
</body>
</html>
