<x-layout>
    @component('layouts.navigation')
    @endcomponent
    <div class="max-w-4xl mx-auto p-4">


        <div class="bg-white p-6 rounded-lg shadow mb-6">
            <div class="flex items-center space-x-4">

                <div class="shrink-0">
                    @if($author->image)
                    <img src="{{ asset($author->image) }}" alt="{{ $author->name }}"
                        class="w-16 h-16 rounded-full object-cover border-2 border-gray-200">
                    @else
                    <div class="w-16 h-16 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold text-xl">
                        {{ substr($author->name, 0, 1) }}
                    </div>
                    @endif
                </div>

                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Posts by {{ $author->name }}</h1>
                    <p class="text-gray-600 mt-1">Total Posts: {{ $posts->count() }}</p>
                </div>
            </div>
        </div>


        <div class="space-y-6">
            @if($posts->count() > 0)
            @foreach($posts as $post)
            <div class="bg-white p-6 rounded-lg shadow">

                @if($post->image)
                <img src="{{ asset($post->image) }}" alt="{{ $post->title }}" class="w-full h-48 object-cover rounded mb-4">
                @endif


                <h2 class="text-xl font-semibold text-gray-800 mb-2">
                    <a href="{{ route('post.details', $post->id) }}" class="hover:text-blue-600">
                        {{ $post->title }}
                    </a>
                </h2>


                <p class="text-gray-600 mb-4">
                    {{ Str::limit(strip_tags($post->content), 150) }}
                </p>


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
                    <span class="flex gap-2 ml-2.5 border-l border-gray-300 px-2">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
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


        <div class="bg-white p-6 rounded-lg shadow mt-6">
            <div class="flex items-center space-x-4 mb-4">

                @if($author->image)
                <img src="{{ asset($author->image) }}" alt="{{ $author->name }}"
                    class="w-20 h-20 rounded-full object-cover border-2 border-gray-200">
                @else
                <div class="w-20 h-20 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold text-2xl">
                    {{ substr($author->name, 0, 1) }}
                </div>
                @endif
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">{{ $author->name }}</h3>
                    <p class="text-sm text-gray-500">
                        Member since {{ $author->created_at->format('M Y') }}
                    </p>
                </div>
            </div>


            <div class="text-sm text-gray-600">
                <p class="mb-2">📝 {{ $posts->count() }} posts published</p>

            </div>
        </div>
    </div>
    @component('layouts.footer')
    @endcomponent
</x-layout>