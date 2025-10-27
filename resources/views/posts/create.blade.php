<x-layout>
    @component('dashboard.navbar')
    @endcomponent
    @component('dashboard.sidebar')
    @endcomponent

    <div class="p-4 sm:ml-64">
        <div class="mt-14">
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-800">{{isset($post) ? 'Update' : 'Create New'}} Post</h1>
                <p class="text-gray-600">{{isset($post) ? 'Update your post' : 'Add a new blog post to your website'}}</p>
            </div>

            <div class="bg-white rounded-lg border border-gray-200 p-6">
                <form action="{{ isset($post) ? route('post.update', $post->id) : route('post.create') }}" method="POST" enctype="multipart/form-data" id="postForm">
                    @csrf
                    @if(isset($post))
                    @method('PATCH')
                    @else
                    @method('POST')
                    @endif

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

                    {{-- Text Editor Section --}}
                    <div class="mb-4">
                        <label for="content" class="block text-gray-700 mb-2">Content *</label>
                        <textarea
                            id="content"
                            name="content"
                            required
                            class="hidden">{!! old('content', $post->content ?? '') !!}</textarea>
                        @error('content')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>


                    <div class="mb-4">
                        <label for="image" class="block text-gray-700 mb-2">Featured Image</label>
                        @if(isset($post) && $post->image)
                        <div class="mb-3">
                            <p class="text-gray-600 text-sm mb-2">Current Image:</p>
                            <img src="{{ asset($post->image) }}"
                                alt="Current featured image"
                                class="h-32 w-64 rounded border shadow-sm">
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

                    <div class="mb-6">
                        <label class="block text-gray-700 mb-2">Status *</label>
                        <div class="flex space-x-4">
                            <label class="flex items-center">
                                <input
                                    type="radio"
                                    name="status"
                                    value="published"
                                    {{ old('status', isset($post) ? $post->status : '') == 'published' ? 'checked' : '' }}
                                    class="mr-2">
                                <span class="text-gray-700">Published</span>
                            </label>
                            <label class="flex items-center">
                                <input
                                    type="radio"
                                    name="status"
                                    value="unpublished"
                                    {{ old('status', isset($post) ? $post->status : 'unpublished') == 'unpublished' ? 'checked' : '' }}
                                    class="mr-2">
                                <span class="text-gray-700">Unpublished</span>
                            </label>
                        </div>
                        @error('status')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

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

    {{-- TinyMCE CDN --}}
    <script src="https://cdn.tiny.cloud/1/4mdujpp3aa3rqkgdw0xqfnxg7il9o4dztsm6rntxk0tfc6ny/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize TinyMCE with proper encoding settings
        tinymce.init({
            selector: '#content',
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'charmap', 'preview', 'anchor',
                'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', 'media', 'table', 'help', 'wordcount'
            ],
            toolbar: 'undo redo | blocks | bold italic underline strikethrough | ' +
                'alignleft aligncenter alignright alignjustify | ' +
                'bullist numlist outdent indent | link | ' +
                'forecolor backcolor removeformat | table help | ' +
                'charmap emoticons | code fullscreen preview',
            toolbar_mode: 'sliding',
            height: 500,
            menubar: false, // Simplified - remove menubar to avoid complexity
            // Force raw encoding to prevent double encoding
            entity_encoding: 'raw',
            // Prevent automatic conversion of characters
            entities: 'raw',
            // Ensure content is treated as HTML
            forced_root_block: 'p',
            // Setup callback to handle initial content properly
            setup: function (editor) {
                editor.on('init', function () {
                    // Get the raw content from textarea
                    const initialContent = document.getElementById('content').value;
                    if (initialContent) {
                        // Set the content directly without processing
                        editor.setContent(initialContent, { format: 'raw' });
                    }
                });

                // Save content back to textarea on change
                editor.on('change keyup', function () {
                    editor.save();
                });
            },
            // Content style
            content_style: `
                body {
                    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
                    font-size: 16px;
                    line-height: 1.6;
                    color: #374151;
                }
                h1 { font-size: 2em; color: #111827; margin-bottom: 0.5em; }
                h2 { font-size: 1.5em; color: #1f2937; margin-bottom: 0.5em; }
                h3 { font-size: 1.25em; color: #374151; margin-bottom: 0.5em; }
                p { margin-bottom: 1em; }
                table { border-collapse: collapse; width: 100%; }
                table, th, td { border: 1px solid #d1d5db; }
                th, td { padding: 8px 12px; text-align: left; }
                blockquote {
                    border-left: 4px solid #3b82f6;
                    margin: 1em 0;
                    padding-left: 1em;
                    color: #6b7280;
                    font-style: italic;
                }
            `
        });
    });
    </script>
</x-layout>
