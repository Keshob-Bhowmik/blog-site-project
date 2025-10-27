<?php
$isLogin = false;
if (auth()->check()) {
    $isLogin = true;
}
?>

<x-layout>
    <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start rtl:justify-end">
                    <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                        </svg>
                    </button>
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
                <div class="flex items-center">
                    <div class="flex items-center ms-3">
                        <div class="flex gap-2 items-center">
                            <div>
                                <h1>{{auth()->user()->name}}</h1>
                            </div>
                            <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300" aria-expanded="false" data-dropdown-toggle="dropdown-user">
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
                        </div>
                        <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-sm shadow-sm" id="dropdown-user">
                            <div class="px-4 py-3" role="none">
                                <p class="text-sm text-gray-900" role="none">
                                    {{auth()->user()->name}}
                                </p>
                                <p class="text-sm font-medium text-gray-900 truncate" role="none">
                                    {{auth()->user()->email}}
                                </p>
                            </div>
                            <ul class="py-1" role="none">
                                <li>
                                    <a href="{{route('index')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Home</a>
                                </li>

                                <li>
                                    <a href="{{route('logout')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Sign out</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</x-layout>