<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Posts') }}
    </h2>
    @auth
    <div class="mt-2">
        <a href="/posts/create">
            <x-button>create</x-button>
        </a>
    </div>
    @endauth
</x-slot>

<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

    @foreach($posts as $post)
    <a href="/posts/{{ $post->slug }}">
        <div class="px-4 py-5 bg-white sm:p-6 shadow mt-2 transform transition-transform duration-300 hover:scale-105 hover:font-bold rounded-lg">
            <h1 class="text-xl">{{ $post->title }}</h1>
            <small>{{ $post->created_at->format('M j, Y h:i A') }}</small>
        </div>
    </a>
    @endforeach

    <div class="mt-10">
        {{ $posts->links() }}
    </div>

</div>