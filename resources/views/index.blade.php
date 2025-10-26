

<x-layout>

@component('layouts.navigation')
@endcomponent

    <section class="relative py-20 bg-cover bg-center bg-no-repeat"
        style="background-image: url('http://localhost:8000/images/blog_banner.jpg');">


        <div class="absolute inset-0 bg-black opacity-40"></div>

        <div class="relative max-w-4xl mx-auto px-4 text-center text-white">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6">
                Welcome to Our Blog
            </h1>
            <p class="text-xl md:text-2xl mb-8 text-gray-200">
                Discover inspiring stories, helpful tips, and latest trends
            </p>


            <div class="max-w-2xl mx-auto mb-8">
                <form action="{{ route('index') }}" method="GET" class="flex">
                    <div class="relative flex-1">
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Search for authors or posts..."
                            class="w-full px-6 py-4 rounded-l-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 border-0">
                        <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <button
                        type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-r-lg font-semibold transition duration-300 whitespace-nowrap">
                        Search
                    </button>
                </form>
                <p class="text-sm text-gray-300 mt-2">
                    Find your favorite writers and explore their content
                </p>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}" class="bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-300 text-center">
                    Start Reading
                </a>
                <a href="#posts" class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-gray-900 transition duration-300 text-center">
                    Latest Posts
                </a>
            </div>
        </div>
    </section>

    <div class="mt-14">
        <h1 class="text-center font-bold underline text-4xl">
            @if(request()->has('search') && !empty(request('search')))
            @if($posts->count() > 0)
            Found {{ $posts->count() }} results for "{{ request('search') }}"
            @else
            No results found for "{{ request('search') }}"
            @endif
            @else
            {{ $posts->count() > 0 ? 'All Posts' : 'No Posts Available' }}
            @endif

        </h1>
    </div>

    <div class="mt-14 p-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($posts as $post)
            <div class="bg-white border border-gray-200 rounded-lg shadow hover:shadow-md transition-shadow">

                <div class="relative">
                    @if($post->image)
                    <img class="w-full h-48 object-cover rounded-t-lg"
                        src="{{ asset($post->image) }}"
                        alt="{{ $post->title }}">
                    @else
                    <div class="w-full h-48 bg-linear-to-br from-blue-400 to-purple-500 rounded-t-lg flex items-center justify-center">
                        <div class="text-center text-white">
                            <svg class="w-12 h-12 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                            <p class="text-sm font-medium">No Image</p>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Content Section -->
                <div class="p-4">
                    <p class="font-bold text-sm mb-4">Author: <span class="text-blue-600">{{$post->user->name}}</span></p>
                    <!-- Title -->
                    <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2">
                        {{ $post->title }}
                    </h3>

                    <!-- Content Excerpt -->
                    <p class="text-gray-600 text-sm mb-4 line-clamp-3 min-h-[60px]">
                        {{ Str::limit($post->content, 100) }}
                    </p>

                    <!-- Meta Information -->
                    <div class="flex items-center justify-between mb-4">
                        @if($post->category)
                        <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">
                            {{ $post->category->name }}
                        </span>
                        @endif
                        <span class="text-gray-500 text-sm">
                            {{ $post->created_at->format('M d, Y') }}
                        </span>
                    </div>

                    <!-- Read More Button -->
                    <a href="{{route('post.details', $post->id)}}" class="w-full bg-blue-600 hover:bg-blue-700 text-white text-center py-2 px-4 rounded-lg block transition-colors">
                        Read More
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@component('layouts.footer')
@endcomponent
</x-layout>
