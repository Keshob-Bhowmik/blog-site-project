<x-layout>
    @component('dashboard.navbar')
    @endcomponent
    @component('dashboard.sidebar')
    @endcomponent

    <div class="p-20 sm:ml-64">
        <div class="flex">
            <!-- Main Content -->
            <div class="flex-1 p-8">
                <div class="max-w-md mx-auto">
                    <!-- Header -->
                    <div class="text-center mb-8">
                        <h1 class="text-3xl font-bold text-gray-800">Edit Profile</h1>
                        <p class="text-gray-600 mt-2">Update your profile information</p>
                    </div>

                    <!-- Edit Profile Form -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Profile Header with Avatar -->
                            <div class="bg-blue-500 h-32 relative">
                                <div class="absolute -bottom-8 left-1/2 transform -translate-x-1/2">
                                    <div class="relative">
                                        <div class="w-24 h-24 bg-gray-300 rounded-full border-4 border-white shadow-lg flex items-center justify-center">
                                            @php
                                                $initials = collect(explode(' ', $user->name))
                                                    ->take(2)
                                                    ->map(fn($part) => mb_substr($part, 0, 1))
                                                    ->implode(' ');
                                            @endphp
                                            <span class="text-2xl font-bold text-gray-600">{{ $initials }}</span>
                                        </div>
                                        <label for="avatar" class="absolute bottom-0 right-0 bg-blue-500 text-white p-2 rounded-full cursor-pointer hover:bg-blue-600 transition duration-200 shadow-lg">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            <input type="file" id="avatar" name="image" class="hidden" accept="image/*">
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Form Content -->
                            <div class="pt-16 px-8 pb-8">
                                <!-- Name Field -->
                                <div class="space-y-2">
                                    <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                                           placeholder="Enter your full name">
                                    @error('name')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Form Actions -->
                                <div class="flex gap-4 mt-8">
                                    <a href="{{ route('profile.index') }}"
                                       class="flex-1 px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition duration-200 text-center">
                                        Cancel
                                    </a>
                                    <button type="submit"
                                            class="flex-1 px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-200">
                                        Save Changes
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
