<?php
$isLogin = false;
if (auth()->check()) {
    $isLogin = true;
}
?>
<x-layout>
    @component('layouts.navigation')
    @endcomponent

    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <!-- Post Card -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <!-- Your existing post content remains the same -->
            @if($post->image)
            <div class="mb-6">
                <img src="{{ asset($post->image) }}"
                    alt="{{ $post->title }}"
                    class="w-full h-64 object-cover rounded-lg">
            </div>
            @endif

            <!-- Post Meta Information -->
            <div class="flex items-center justify-between mb-6 pb-4 border-b">
                <div class="flex-col items-center space-x-4 space-y-3.5">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold">
                            {{ substr($post->user->name, 0, 1) }}
                        </div>
                        <div class="ml-3">
                            <a href="{{route('author.index', $post->user_id)}}" class="font-medium text-gray-900 hover:underline">{{ $post->user->name }}</a>
                            <p class="text-sm text-gray-500">Author</p>
                        </div>
                    </div>

                    @if($post->category)
                    <div class="flex items-center">
                        <div>
                            <h1>category:</h1>
                        </div>
                        <div class="ml-4">
                            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">
                                {{ $post->category->name }}
                            </span>
                        </div>
                    </div>
                    @endif
                    <div>
                        <h1>Views: {{$viewCount}}</h1>
                    </div>
                </div>

                <!-- Date -->
                <div class="text-right">
                    <p class="text-sm text-gray-500">Published on</p>
                    <p class="font-medium text-gray-900">{{ $post->created_at->format('F d, Y') }}</p>
                </div>
            </div>

            <!-- Post Title -->
            <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $post->title }}</h1>

            <!-- Post Content -->
            <div class="prose max-w-none">
                <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $post->content }}</p>
            </div>

            <!-- Action Buttons -->
            <div class="mt-8 pt-6 border-t flex space-x-4">
                <a href="{{ url('/') }}"
                    class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                    ← Back to Posts
                </a>
                <button class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300">
                    Share
                </button>
            </div>
        </div>

        <!-- Comment Section -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-4">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Comments ({{ $post->comments->count() }})</h2>

            <!-- Add Comment Form -->

            <div class="mb-8 p-4 bg-gray-50 rounded-lg">
                @if($isLogin)
                <h3 class="text-lg font-semibold mb-4">Add a Comment</h3>
                <form action="{{ route('comment.store', $post->id) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <textarea
                            name="body"
                            rows="4"
                            placeholder="Write your comment here..."
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>{{ old('body') }}</textarea>
                    </div>
                    <button
                        type="submit"
                        class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                        Post Comment
                    </button>
                </form>
                @else

                <p class="text-red-600 font-bold">You must be Logged In to comment!!</p>
                <div class="mt-9">
                    <a href="{{route('login')}}" class="bg-blue-600 px-4 py-2.5 text-white font-medium rounded-md">Log In</a>
                    <a href="{{route('register')}}" class="bg-blue-600 px-2.5 py-2.5 text-white font-medium rounded-md">Register</a>
                </div>
            </div>
        </div>


        @endif

        <!-- Real Comments -->
         <h1 class="text-2xl font-bold text-gray-900 mt-14 mb-6">All Comments</h1>
        @foreach($post->comments as $comment)
        <div class="border-b border-gray-200 pb-6 mb-6">

            <div class="flex items-start space-x-3">

                <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold">
                    {{ substr($comment->user->name, 0, 1) }}
                </div>
                <div class="flex-1">
                    <div class="flex justify-between items-center mb-2">
                        <h4 class="font-semibold text-gray-900">{{ $comment->user->name }}</h4>
                        <span class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                    </div>
                    <p class="text-gray-700">{{ $comment->body }}</p>
                </div>
            </div>
        </div>
        @endforeach

        <!-- No Comments Message -->
        @if($post->comments->count() == 0)
        <div class="text-center py-8">
            <p class="text-gray-500">No comments yet. Be the first to comment!</p>
        </div>
        @endif
    </div>
    </div>
</x-layout>
