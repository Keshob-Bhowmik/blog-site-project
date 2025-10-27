<x-layout>
    @component('dashboard.navbar')
    @endcomponent
    @component('dashboard.sidebar')
    @endcomponent

    <div class="p-4 sm:ml-64">
        <div class="mt-14">
           
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-gray-800">{{isset($category) ? 'Update Category' : 'Create Category'}}</h1>
                <p class="text-gray-600 mt-2">{{isset($category) ? 'Update category information' : 'Create a new category'}}</p>
            </div>


            <div class="max-w-2xl mx-auto">
                <div class="bg-white rounded-lg border border-gray-200 p-6">
                    <form action="{{ isset($category) ? route('category.update', $category->id) : route('category.store') }}" method="POST">
                        @csrf
                        @if(isset($category))
                        @method('PUT')
                        @else
                        @method('POST')
                        @endif


                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Category Name</label>
                            <input type="text"
                                id="name"
                                name="name"
                                value="{{ old('name', $category->name ?? '') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Enter category name">
                            @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>




                        <div class="flex gap-3 mt-6">
                            <a href="{{ route('category.index') }}"
                                class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50">
                                Cancel
                            </a>
                            <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                Update Category
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>
