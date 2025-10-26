<x-layout>
    @component('layouts.navigation')
    @endcomponent
    <div class="max-w-4xl mx-auto p-4">
        <!-- Author Header -->
        <div class="bg-white p-6 rounded-lg shadow mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Posts by {{ $author->name }}</h1>
            <p class="text-gray-600 mt-2">Total Posts: {{ $posts->count() }}</p>
        </div>

        <!-- Posts List -->
        <div class="space-y-6">
            @if($posts->count() > 0)
            @foreach($posts as $post)
            <div class="bg-white p-6 rounded-lg shadow">
                <!-- Post Image -->
                @if($post->image)
                <img src="{{ asset($post->image) }}" alt="{{ $post->title }}" class="w-full h-48 object-cover rounded mb-4">
                @endif

                <!-- Post Title -->
                <h2 class="text-xl font-semibold text-gray-800 mb-2">
                    <a href="{{ route('post.details', $post->id) }}" class="hover:text-blue-600">
                        {{ $post->title }}
                    </a>
                </h2>

                <!-- Post Content Excerpt -->
                <p class="text-gray-600 mb-4">
                    {{ Str::limit(strip_tags($post->content), 150) }}
                </p>

                <!-- Post Meta -->
                <div class="flex items-center text-sm text-gray-500">
                    <span class="mr-4">
                        📅 {{ $post->created_at->format('M d, Y') }}
                    </span>
                    <span class="mr-4 flex gap-2 items-center">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z" />
                        </svg>
                        {{ $post->category->name ?? 'Uncategorized' }}
                    </span>
                    <span class="flex gap-2">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                            <circle cx="12" cy="12" r="3" />
                        </svg>
                        {{ $post->views->count() }} views
                    </span>
                    <span class="flex gap-2 ml-2.5 border-l border-red-700 px-2">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z" />
                        </svg>
                        {{ $post->comments->count() }} comments
                    </span>
                </div>
            </div>
            @endforeach
            @else
            <div class="bg-white p-6 rounded-lg shadow text-center">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">No posts yet</h3>
                <p class="text-gray-600">{{ $author->name }} hasn't published any posts yet.</p>
            </div>
            @endif
        </div>

        <!-- Author Sidebar -->
        <div class="bg-white p-6 rounded-lg shadow mt-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">About {{ $author->name }}</h3>

            <p class="text-sm text-gray-500">
                Joined: {{ $author->created_at->format('M Y') }}
            </p>
        </div>
    </div>
</x-layout>
