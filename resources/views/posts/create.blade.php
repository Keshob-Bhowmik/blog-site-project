<x-layout>
    @component('dashboard.navbar')
    @endcomponent
    @component('dashboard.sidebar')
    @endcomponent

    <div class="p-4 sm:ml-64">
        <div class="mt-14">
            <!-- Page Header -->
            <div class="mb-6">

                <h1 class="text-2xl font-bold text-gray-800">{{isset($post) ? 'Update' : 'Create New'}} Post</h1>
                <p class="text-gray-600">{{isset($post) ? 'Update your post' : 'Add a new blog post to your website'}}</p>
            </div>

            <!-- Create Post Form -->
            <div class="bg-white rounded-lg border border-gray-200 p-6">
                <form action="{{ isset($post) ? route('post.update', $post->id) : route('post.create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if(isset($post))
                    @method('PATCH')
                    @else
                    @method('POST')
                    @endif
                    <!-- Title Input -->
                    <div class="mb-4">
                        <label for="title" class="block text-gray-700 mb-2">Post Title *</label>
                        <input
                            type="text"
                            id="title"
                            name="title"
                            value="{{ old('title', $post->title ?? '') }}"
                            required
                            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500"
                            placeholder="Enter post title">
                        @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Content Textarea -->
                    <div class="mb-4">
                        <label for="content" class="block text-gray-700 mb-2">Content *</label>
                        <textarea
                            id="content"
                            name="content"
                            rows="10"
                            required
                            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500"
                            placeholder="Write your post content here...">{{ old('content', $post->content ?? '') }}</textarea>
                        @error('content')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category Selection -->
                    <div class="mb-4">
                        <label for="category_id" class="block text-gray-700 mb-2">Category</label>
                        <select
                            id="category_id"
                            name="category_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                            <option value="">Select a category</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ (old('category_id', $post->category_id ?? '') == $category->id) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Image Upload -->
                    <div class="mb-4">
                        <label for="image" class="block text-gray-700 mb-2">Featured Image</label>

                        <!-- Current Image Preview -->
                        @if(isset($post) && $post->image)
                        <div class="mb-3">
                            <p class="text-gray-600 text-sm mb-2">Current Image:</p>
                            <img src="{{ asset($post->image) }}"
                                alt="Current featured image"
                                class="h-32 w-auto rounded border shadow-sm">

                            <div class="mt-2">
                                <label class="flex items-center text-sm text-gray-600">
                                    <input type="checkbox" name="remove_image" value="1" class="mr-2">
                                    Remove current image
                                </label>
                            </div>
                        </div>
                        @endif

                        <input
                            type="file"
                            id="image"
                            name="image"
                            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500"
                            accept="image/*">
                        <p class="text-gray-500 text-sm mt-1">Allowed: JPEG, PNG, JPG, GIF, SVG | Max: 2MB</p>

                        @error('image')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status Selection -->
                    <div class="mb-6">
                        <label class="block text-gray-700 mb-2">Status *</label>
                        <div class="flex space-x-4">
                            <label class="flex items-center">
                                <input
                                    type="radio"
                                    name="status"
                                    value="published"
                                    {{ old('status') == 'published' ? 'checked' : '' }}
                                    class="mr-2">
                                <span class="text-gray-700">Published</span>
                            </label>
                            <label class="flex items-center">
                                <input
                                    type="radio"
                                    name="status"
                                    value="unpublished"
                                    {{ old('status', 'unpublished') == 'unpublished' ? 'checked' : '' }}
                                    class="mr-2">
                                <span class="text-gray-700">Unpublished</span>
                            </label>
                        </div>
                        @error('status')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Form Actions -->
                    <div class="flex justify-end space-x-3 pt-4 border-t">
                        <a
                            href="{{ route('dashboard.index') }}"
                            class="px-4 py-2 border border-gray-300 text-gray-700 rounded hover:bg-gray-50">
                            Cancel
                        </a>
                        <button
                            type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            {{isset($post) ? 'Update' : 'Create'}}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>
