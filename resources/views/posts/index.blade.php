<x-layout>
    @component('dashboard.navbar')
    @endcomponent
    @component('dashboard.sidebar')
    @endcomponent

    <div class="p-4 sm:ml-64">
        <div class="mt-14">

            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-800">Posts Management</h1>
                <p class="text-gray-600 mt-2">Manage and view all posts</p>
            </div>


            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 mb-8">

                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 lg:col-span-3">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <div class="p-3 rounded-lg bg-blue-100 mr-4">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9m0 0v12m0 0h6m-6 0h6"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-600">
                                    @if(auth()->user()->role === 'admin')
                                    @if(request('view')=== 'my')
                                    My Posts
                                    @else
                                    All Posts
                                    @endif
                                    @else
                                    My Posts
                                    @endif
                                </p>
                                <p class="text-2xl font-bold text-gray-800">
                                    @if(auth()->user()->role === 'admin' && request('view') === 'my')
                                    {{ $myPostsCount }}
                                    @else
                                    {{ auth()->user()->role === 'admin' ? $totalPostsCount : $myPostsCount }}
                                    @endif
                                </p>
                            </div>
                        </div>


                        @if(auth()->user()->role === 'admin')
                        <div class="flex items-center space-x-4">
                            <span class="text-sm font-medium {{ request('view') !== 'my' ? 'text-blue-600' : 'text-gray-500' }}">
                                All Posts
                            </span>

                            <a href="{{ route('post.index', array_merge(request()->query(), ['view' => request('view') === 'my' ? 'all' : 'my'])) }}"
                                class="w-12 h-6 bg-gray-300 rounded-full p-1 block transition duration-200 ease-in-out hover:bg-gray-400">
                                <div class="bg-white w-4 h-4 rounded-full shadow transform transition duration-200 ease-in-out {{ request('view') === 'my' ? 'translate-x-2 ml-6' : 'translate-x-0' }}"></div>
                            </a>

                            <span class="text-sm font-medium {{ request('view') === 'my' ? 'text-blue-600' : 'text-gray-500' }}">
                                My Posts
                            </span>
                        </div>
                        @endif
                    </div>
                </div>


                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <div class="text-center">
                        <div class="p-3 rounded-lg bg-green-100 inline-flex mb-3">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </div>
                        <p class="text-sm font-medium text-gray-600 mb-2">Create New Post</p>
                        <a href="{{ route('post.create') }}">
                            <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-300 w-full">
                                + New Post
                            </button>
                        </a>
                    </div>
                </div>
            </div>


            <form method="GET" action="{{ route('post.index') }}" class="bg-gray-50 p-4 rounded-lg mb-6">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Filter Posts</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

                    @if(auth()->user()->role == 'admin')
                    <div class="relative">
                        <label for="author" class="block text-sm font-medium text-gray-700 mb-1">Author Name</label>
                        <input type="text"
                            id="author"
                            name="author"
                            value="{{ request('author') }}"
                            placeholder="Start typing author name..."
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            autocomplete="off">
                        <!-- Autocomplete dropdown -->
                        <div id="author-suggestions" class="absolute z-50 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg hidden max-h-60 overflow-y-auto"></div>
                    </div>
                    @endif


                    <div class="relative">
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                        <input type="text"
                            id="category"
                            name="category_name"
                            value="{{ request('category_name') }}"
                            placeholder="Start typing category name..."
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            autocomplete="off">
                        <!-- Hidden field to store category ID -->
                        <input type="hidden" id="category_id" name="category_id" value="{{ request('category_id') }}">
                        <!-- Autocomplete dropdown -->
                        <div id="category-suggestions" class="absolute z-50 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg hidden max-h-60 overflow-y-auto"></div>
                    </div>


                    <div>
                        <label for="post_id" class="block text-sm font-medium text-gray-700 mb-1">Post ID</label>
                        <input type="text"
                            id="post_id"
                            name="post_id"
                            value="{{ request('post_id') }}"
                            placeholder="Enter post ID"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>


                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select id="status"
                            name="status"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">All Statuses</option>
                            <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                            <option value="unpublished" {{ request('status') == 'unpublished' ? 'selected' : '' }}>Unpublished</option>
                        </select>
                    </div>
                </div>

                <!-- Hidden fields for sorting -->
                <input type="hidden" name="sort_by" id="sort_by" value="{{ request('sort_by', 'created_at') }}">
                <input type="hidden" name="sort_order" id="sort_order" value="{{ request('sort_order', 'desc') }}">

                @if(request('view'))
                <input type="hidden" name="view" value="{{ request('view') }}">
                @endif


                <div class="mt-4 flex space-x-3">
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Apply Filters
                    </button>
                    <a href="{{ route('post.index', ['view' => request('view'), 'sort_by' => request('sort_by'), 'sort_order' => request('sort_order')]) }}"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500">
                        Clear Filters
                    </a>
                </div>
            </form>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200">

                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-semibold text-gray-800">
                            @if(auth()->user()->role === 'admin' && request('view') === 'my')
                            My Posts ({{ $posts->count() }})
                            @elseif(auth()->user()->role === 'admin')
                            All Posts ({{ $posts->count() }})
                            @else
                            My Posts ({{ $posts->count() }})
                            @endif
                        </h2>
                        <div class="text-sm text-gray-500">
                            @if(request('view') === 'my')
                            Showing your posts only
                            @else
                            Showing posts from all users
                            @endif
                        </div>
                    </div>
                </div>


                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thumbnail</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Author</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <button type="button"
                                        onclick="sortByViews()"
                                        class="flex items-center space-x-1 hover:text-gray-700 focus:outline-none">
                                        <span>Views</span>
                                        <div class="flex flex-col">
                                            <!-- Up arrow for ascending -->
                                            <svg class="w-3 h-3 {{ request('sort_by') == 'views' && request('sort_order') == 'asc' ? 'text-blue-600' : 'text-gray-400' }}"
                                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                                            </svg>
                                            <!-- Down arrow for descending -->
                                            <svg class="w-3 h-3 {{ request('sort_by') == 'views' && request('sort_order') == 'desc' ? 'text-blue-600' : 'text-gray-400' }}"
                                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </button>
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($posts as $post)
                            <tr class="hover:bg-gray-50 transition duration-150">
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900 max-w-xs">{{ $post->id }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">

                                        <div class="text-sm font-medium text-gray-900">{{ Str::limit($post->title, 15) }}</div>
                                    </div>
                                </td>
                                <td>
                                    <div class="flex justify-center">
                                        @if($post->image)
                                    <img src="{{ asset($post->image) }}" alt="{{ $post->title }}" class="w-24 h-14 rounded-lg object-cover mr-3">
                                    @else
                                    <div class="w-24 h-14 bg-gray-200 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    @endif
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $post->user->name }}</div>
                                    @if($post->user_id == auth()->id())
                                    <span class="text-xs text-blue-600 font-medium">(You)</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        {{ $post->category ? $post->category->name : 'Uncategorized' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                        {{ $post->status === 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ ucfirst($post->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $post->created_at->format('M j, Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                    {{ $post->views_count ?? 0 }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{route('post.edit', $post->id)}}"><button class="text-blue-600 hover:text-blue-900 mr-3 transition duration-150">Edit</button></a>
                                    <form action="{{ route('post.delete', $post->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 transition duration-150"
                                            onclick="return confirm('Are you sure you want to delete {{ $post->title }}?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="10" class="px-6 py-8 text-center text-gray-500">
                                    <svg class="w-12 h-12 mx-auto text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <p class="text-lg font-medium">No posts found</p>
                                    <p class="text-sm mt-1">
                                        @if(request('view') === 'my')
                                        You haven't created any posts yet.
                                        @else
                                        There are no posts in the system.
                                        @endif
                                    </p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>


                @if($posts->count() > 0)
                <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                    <div class="flex justify-between items-center">
                        <div class="text-sm text-gray-500">
                            Showing {{ $posts->firstItem() }} to {{ $posts->lastItem() }} of {{ $posts->total() }} results
                            @if(request('view') === 'my')
                            of your posts
                            @else
                            of {{ $totalPostsCount }} total posts
                            @endif
                        </div>


                        <div class="flex items-center space-x-2">
                            {{ $posts->appends([
                                'view' => request('view'),
                                'sort_by' => request('sort_by'),
                                'sort_order' => request('sort_order'),
                                'author' => request('author'),
                                'category_id' => request('category_id'),
                                'post_id' => request('post_id'),
                                'status' => request('status')
                            ])->links() }}
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize both autocomplete functions
            initializeAuthorAutocomplete();
            initializeCategoryAutocomplete();
        });

        // Sorting function for views
        function sortByViews() {
            const currentSortBy = document.getElementById('sort_by').value;
            const currentSortOrder = document.getElementById('sort_order').value;

            let newSortOrder = 'desc';

            // If already sorting by views, toggle the order
            if (currentSortBy === 'views') {
                newSortOrder = currentSortOrder === 'desc' ? 'asc' : 'desc';
            }

            // Set the new sorting parameters
            document.getElementById('sort_by').value = 'views';
            document.getElementById('sort_order').value = newSortOrder;

            // Submit the form
            document.querySelector('form').submit();
        }

        // Author Autocomplete Function
        function initializeAuthorAutocomplete() {
            const authorInput = document.getElementById('author');
            const suggestionsContainer = document.getElementById('author-suggestions');

            if (!authorInput) return;

            // Handle input event
            authorInput.addEventListener('input', function() {
                const searchTerm = this.value.trim();

                if (searchTerm.length < 2) {
                    suggestionsContainer.classList.add('hidden');
                    return;
                }

                fetch(`/api/users/autocomplete?search=${encodeURIComponent(searchTerm)}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(users => {
                        if (users.length === 0) {
                            suggestionsContainer.classList.add('hidden');
                            return;
                        }

                        suggestionsContainer.innerHTML = '';
                        users.forEach(user => {
                            const suggestionItem = document.createElement('div');
                            suggestionItem.className = 'px-3 py-2 cursor-pointer hover:bg-blue-50 border-b border-gray-100 last:border-b-0 text-sm text-gray-700';
                            suggestionItem.textContent = user.name;

                            suggestionItem.addEventListener('click', function() {
                                authorInput.value = user.name;
                                suggestionsContainer.classList.add('hidden');
                            });

                            suggestionsContainer.appendChild(suggestionItem);
                        });

                        suggestionsContainer.classList.remove('hidden');
                    })
                    .catch(error => {
                        console.error('Error fetching users:', error);
                        suggestionsContainer.classList.add('hidden');
                    });
            });

            // Hide suggestions when clicking outside
            document.addEventListener('click', function(event) {
                if (!authorInput.contains(event.target) && !suggestionsContainer.contains(event.target)) {
                    suggestionsContainer.classList.add('hidden');
                }
            });

            // Hide suggestions on escape key
            authorInput.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    suggestionsContainer.classList.add('hidden');
                }
            });
        }

        // Category Autocomplete Function
        function initializeCategoryAutocomplete() {
            const categoryInput = document.getElementById('category');
            const categoryIdInput = document.getElementById('category_id');
            const categorySuggestionsContainer = document.getElementById('category-suggestions');

            if (!categoryInput) return;

            // Handle input event
            categoryInput.addEventListener('input', function() {
                const searchTerm = this.value.trim();

                if (searchTerm.length < 2) {
                    categorySuggestionsContainer.classList.add('hidden');
                    return;
                }

                fetch(`/api/categories/autocomplete?search=${encodeURIComponent(searchTerm)}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(categories => {
                        if (categories.length === 0) {
                            categorySuggestionsContainer.classList.add('hidden');
                            return;
                        }

                        categorySuggestionsContainer.innerHTML = '';
                        categories.forEach(category => {
                            const suggestionItem = document.createElement('div');
                            suggestionItem.className = 'px-3 py-2 cursor-pointer hover:bg-green-50 border-b border-gray-100 last:border-b-0 text-sm text-gray-700';
                            suggestionItem.textContent = category.name;

                            suggestionItem.addEventListener('click', function() {
                                categoryInput.value = category.name;
                                if (categoryIdInput) {
                                    categoryIdInput.value = category.id;
                                }
                                categorySuggestionsContainer.classList.add('hidden');
                            });

                            categorySuggestionsContainer.appendChild(suggestionItem);
                        });

                        categorySuggestionsContainer.classList.remove('hidden');
                    })
                    .catch(error => {
                        console.error('Error fetching categories:', error);
                        categorySuggestionsContainer.classList.add('hidden');
                    });
            });

            // Hide suggestions when clicking outside
            document.addEventListener('click', function(event) {
                if (!categoryInput.contains(event.target) && !categorySuggestionsContainer.contains(event.target)) {
                    categorySuggestionsContainer.classList.add('hidden');
                }
            });

            // Hide suggestions on escape key
            categoryInput.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    categorySuggestionsContainer.classList.add('hidden');
                }
            });

            // Clear category ID when input is cleared
            categoryInput.addEventListener('change', function() {
                if (this.value === '' && categoryIdInput) {
                    categoryIdInput.value = '';
                }
            });
        }
    </script>
</x-layout>
