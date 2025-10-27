<x-layout>
    @component('dashboard.navbar')
    @endcomponent
    @component('dashboard.sidebar')
    @endcomponent


    <div class="p-20 sm:ml-64">


        <div class="flex">



            <div class="flex-1 p-8">
                <div class="max-w-4xl mx-auto">

                    <div class="text-center mb-8">
                        <h1 class="text-3xl font-bold text-gray-800">My Profile</h1>
                        <p class="text-gray-600 mt-2">View your profile information</p>
                    </div>

                    <div class="bg-white rounded-lg shadow-md overflow-hidden">

                        <div class="bg-blue-500 h-32 relative">
                            <div class="absolute -bottom-8 left-8">
                                <div class="w-24 h-24 bg-gray-300 rounded-full border-4 border-white shadow-lg flex items-center justify-center">
                                @if($user->image)
                                <img class="w-24 h-24 bg-gray-300 rounded-full" src="{{asset($user->image)}}" alt="">
                                @else
                                <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold">
                                    {{ substr(auth()->user()->name, 0, 1) }}
                                </div>
                                @endif
                                </div>
                            </div>
                        </div>


                        <div class="pt-12 px-8 pb-8">

                            <div class="flex justify-between items-start mb-8">
                                <div>
                                    <h2 class="text-2xl font-bold text-gray-800">{{$user->name}}</h2>
                                    <p class="text-gray-600">{{$user->email}}</p>
                                    <span class="inline-block mt-2 px-3 py-1 bg-green-100 text-green-800 text-sm font-medium rounded-full">
                                        {{$user->role}}
                                    </span>
                                </div>
                                <a href="{{route('profile.edit')}}">
                                    <button class="px-6 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                                        Edit Profile
                                    </button>
                                </a>
                            </div>


                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                                <div class="space-y-4">
                                    <h3 class="text-lg font-semibold text-gray-800 border-b pb-2">Personal Information</h3>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-600">Full Name</label>
                                        <p class="mt-1 text-gray-800">{{$user->name}}</p>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-600">Email Address</label>
                                        <p class="mt-1 text-gray-800">{{$user->email}}</p>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-600">Role</label>
                                        <p class="mt-1 text-gray-800">{{$user->role}}</p>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-600">Member Since</label>
                                        <p class="mt-1 text-gray-800">{{ $user->created_at->format('F j, Y') }}</p>
                                    </div>
                                </div>


                                <div class="space-y-4">
                                    <h3 class="text-lg font-semibold text-gray-800 border-b pb-2">Additional Information</h3>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-600">Bio</label>
                                        <p class="mt-1 text-gray-800">
                                            Frontend developer passionate about creating beautiful user experiences.
                                        </p>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-600">Location</label>
                                        <p class="mt-1 text-gray-800">New York, USA</p>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-600">Website</label>
                                        <p class="mt-1 text-gray-800">
                                            <a href="#" class="text-blue-500 hover:text-blue-600">
                                                https://johndoe.dev
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-8 pt-6 border-t border-gray-200">
                                <h3 class="text-lg font-semibold text-gray-800 mb-4">Account Statistics</h3>
                                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                    <div class="text-center p-4 bg-gray-50 rounded-lg">
                                        <p class="text-2xl font-bold text-blue-600">{{$postCount}}</p>
                                        <p class="text-sm text-gray-600">Posts</p>
                                    </div>
                                    <div class="text-center p-4 bg-gray-50 rounded-lg">
                                        <p class="text-2xl font-bold text-green-600">{{$commentCount}}</p>
                                        <p class="text-sm text-gray-600">Comments</p>
                                    </div>
                                    <div class="text-center p-4 bg-gray-50 rounded-lg">
                                        <p class="text-2xl font-bold text-purple-600">{{$viewsCount}}</p>
                                        <p class="text-sm text-gray-600">Views</p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
