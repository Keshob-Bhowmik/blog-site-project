<?php
$isLogin = false;
if (auth()->check()) {
    $isLogin = true;
}
?>

<x-layout>
    <nav class="bg-white border-b border-gray-400">
        <div class="max-w-7xl flex flex-wrap items-center justify-between mx-auto p-4">
            <!-- Logo section moved more to the left -->
            <div class="flex items-center">
                <a href="{{route('index')}}" class="flex items-center space-x-2">
                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="32" height="32" rx="6" fill="#3B82F6" />
                        <path d="M8 12C8 11.4477 8.44772 11 9 11H23C23.5523 11 24 11.4477 24 12C24 12.5523 23.5523 13 23 13H9C8.44772 13 8 12.5523 8 12Z" fill="white" />
                        <path d="M8 16C8 15.4477 8.44772 15 9 15H23C23.5523 15 24 15.4477 24 16C24 16.5523 23.5523 17 23 17H9C8.44772 17 8 16.5523 8 16Z" fill="white" />
                        <path d="M9 19C8.44772 19 8 19.4477 8 20C8 20.5523 8.44772 21 9 21H17C17.5523 21 18 20.5523 18 20C18 19.4477 17.5523 19 17 19H9Z" fill="white" />
                        <rect x="8" y="8" width="16" height="14" rx="2" stroke="white" stroke-width="2" />
                    </svg>
                    <span class="self-center text-2xl font-semibold whitespace-nowrap">BlogSite</span>
                </a>
            </div>

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
