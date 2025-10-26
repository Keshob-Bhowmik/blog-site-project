<x-layout>
    @component('dashboard.navbar')
    @endcomponent
    @component('dashboard.sidebar')
    @endcomponent

    <div class="p-4 sm:ml-64">
        <div class="mt-14">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-800">Categories Management</h1>
                <p class="text-gray-600 mt-2">Manage and organize post categories</p>
            </div>

            <!-- Stats and Create Button -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <!-- Total Categories -->
                <div class="bg-white rounded-lg border border-gray-200 p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-lg bg-blue-100 mr-4">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600">Total Categories</p>
                            <p class="text-2xl font-bold text-gray-800">{{$categories->count()}}</p>
                        </div>
                    </div>
                </div>

                <!-- Create Category Card -->
                <div class="bg-white rounded-lg border border-gray-200 p-6 md:col-span-3">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Create New Category</p>
                            <p class="text-sm text-gray-500 mt-1">Add a new category to organize your posts</p>
                        </div>
                        <a href="{{route('category.create')}}"><button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-300">
                                + New Category
                            </button></a>
                    </div>
                </div>
            </div>

            <!-- Categories Table -->
            <div class="bg-white rounded-lg border border-gray-200">
                <!-- Table Header -->
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-semibold text-gray-800">
                            All Categories ({{$categories->count()}})
                        </h2>
                        <div class="text-sm text-gray-500">
                            Showing all categories
                        </div>
                    </div>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Category Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Posts Count</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">

                            @foreach($categories as $category)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{$category->id}}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{$category->name}}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{$category->posts_count}}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('category.edit', $category->id) }}"><button class="text-blue-600 hover:text-blue-900 mr-3">Edit</button></a>
                                    <form action="{{ route('category.delete', $category->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 transition duration-150"
                                            onclick="return confirm('Are you sure you want to delete {{ $category->name }}?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

                <!-- Table Footer -->
                <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                    <div class="flex justify-between items-center">
                        <div class="text-sm text-gray-500">
                            Showing 1 to 4 of 15 results
                        </div>
                        <!-- Pagination -->
                        <div class="flex space-x-2">
                            <button class="px-3 py-1 border border-gray-300 rounded-md text-sm text-gray-400 cursor-not-allowed">Previous</button>
                            <button class="px-3 py-1 border border-gray-300 rounded-md text-sm bg-blue-600 text-white">1</button>
                            <button class="px-3 py-1 border border-gray-300 rounded-md text-sm">2</button>
                            <button class="px-3 py-1 border border-gray-300 rounded-md text-sm">3</button>
                            <button class="px-3 py-1 border border-gray-300 rounded-md text-sm">Next</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
