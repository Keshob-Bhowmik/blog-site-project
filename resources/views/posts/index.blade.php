<x-layout>
    @component('dashboard.navbar')
    @endcomponent
    @component('dashboard.sidebar')
    @endcomponent

    <div class="p-4 sm:ml-64">
        <div class="mt-14">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-800">Posts Management</h1>
                <p class="text-gray-600 mt-2">Manage and view all posts</p>
            </div>

            <!-- Stats Card with Toggle -->
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 mb-8">
                <!-- Posts Count Card -->
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

                        <!-- Toggle Switch -->
                        @if(auth()->user()->role === 'admin')
                        <div class="flex items-center space-x-4">
                            <span class="text-sm font-medium {{ request('view') !== 'my' ? 'text-blue-600' : 'text-gray-500' }}">
                                All Posts
                            </span>

                            <a href="{{ route('post.index', ['view' => request('view') === 'my' ? 'all' : 'my']) }}"
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

                <!-- Create Post Card -->
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

            <!-- Filter Form -->
            <form method="GET" action="{{ route('post.index') }}" class="bg-gray-50 p-4 rounded-lg mb-6">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Filter Posts</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Author Filter -->
                    @if(auth()->user()->role == 'admin')
                    <div>
                        <label for="author" class="block text-sm font-medium text-gray-700 mb-1">Author Name</label>
                        <input type="text"
                            id="author"
                            name="author"
                            value="{{ request('author') }}"
                            placeholder="Enter author name"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    @endif

                    <!-- Category Filter -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                        <select id="category"
                            name="category_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ (old('category_id', $post->category_id ?? '') == $category->id) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Post ID Filter -->
                    <div>
                        <label for="post_id" class="block text-sm font-medium text-gray-700 mb-1">Post ID</label>
                        <input type="text"
                            id="post_id"
                            name="post_id"
                            value="{{ request('post_id') }}"
                            placeholder="Enter post ID"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Status Filter -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select id="status"
                            name="status"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">All Statuses</option>
                            <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                            <option value="unpublished" {{ request('status') == 'unpublished' ? 'selected' : '' }}>unpublished</option>
                        </select>
                    </div>
                </div>

                <!-- Hidden view field to maintain view state -->
                @if(request('view'))
                <input type="hidden" name="view" value="{{ request('view') }}">
                @endif

                <!-- Action Buttons -->
                <div class="mt-4 flex space-x-3">
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Apply Filters
                    </button>
                    <a href="{{ route('post.index', ['view' => request('view')]) }}"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500">
                        Clear Filters
                    </a>
                </div>



            </form>
            <!-- Posts Table -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <!-- Table Header -->
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

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Content</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Author</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Views</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($posts as $post)
                            <tr class="hover:bg-gray-50 transition duration-150">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        @if($post->image)
                                        <img src="{{ asset($post->image) }}" alt="{{ $post->title }}" class="w-10 h-10 rounded-lg object-cover mr-3">
                                        @else
                                        <div class="w-10 h-10 bg-gray-200 rounded-lg flex items-center justify-center mr-3">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                        @endif
                                        <div class="text-sm font-medium text-gray-900">{{ Str::limit($post->title, 30) }}</div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900 max-w-xs">{{ Str::limit($post->content, 50) }}</div>
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
                                    {{ $post->views->count() ?? 0 }}
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
                                <td colspan="8" class="px-6 py-8 text-center text-gray-500">
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

                        <!-- Pagination Links -->
                        <div class="flex items-center space-x-2">
                            {{ $posts->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-layout>
