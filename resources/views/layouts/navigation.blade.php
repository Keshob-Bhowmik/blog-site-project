<?php
$isLogin = false;
if (auth()->check()) {
    $isLogin = true;
}
?>

<x-layout>
    <nav class="bg-white border-gray-200">
        <div class="max-w-7xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="https://flowbite.com/" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap">Flowbite</span>
            </a>
            @if($isLogin)
            <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                <div>
                    <h1 class="mr-3">{{auth()->user()->name}}</h1>
                </div>
                <button type="button" class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
                    <span class="sr-only">Open user menu</span>

                    <div class="w-12 h-12 bg-gray-300 rounded-full border-4 border-white shadow-lg flex items-center justify-center">
                        @if(auth()->user()->image)
                        <img class="w-12 h-12 bg-gray-300 rounded-full" src="{{asset(auth()->user()->image)}}" alt="">

                        @else
                        <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                        @endif
                    </div>

                </button>

                <!-- Dropdown menu -->
                <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow-sm" id="user-dropdown">
                    <div class="px-4 py-3">
                        <span class="block text-sm text-gray-900">{{auth()->user()->name}}</span>
                        <span class="block text-sm  text-gray-500 truncate">{{auth()->user()->email}}</span>
                    </div>
                    <ul class="py-2" aria-labelledby="user-menu-button">
                        <li>
                            <a href="{{route('dashboard.index')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Dashboard</a>
                        </li>

                        <li>
                            <a href="{{route('logout')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Sign out</a>
                        </li>
                    </ul>
                </div>
                <button data-collapse-toggle="navbar-user" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="navbar-user" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
            </div>
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-user">
                
            </div>
            @else
            <div>
                <a href="{{route('login')}}" class="bg-blue-600 px-4 py-2.5 text-white font-medium rounded-md">Log In</a>
                <a href="{{route('register')}}" class="bg-blue-600 px-2.5 py-2.5 text-white font-medium rounded-md">Register</a>
            </div>
            @endif
        </div>
    </nav>
</x-layout>
