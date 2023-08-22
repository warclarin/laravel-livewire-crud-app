<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ $post->title }}
    </h2>
    <small>{{ $post->created_at->format('M j, Y h:i A') }}</small>
    @auth
    <div class="mt-2">
        <a href="/posts/{{ $post->id }}/edit">
            <x-button>edit</x-button>
        </a>
    </div>
    @endauth
</x-slot>
<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <div class="h-48 overflow-hidden">
       <img class="w-full h-full object-cover" src="{{ $post->featured_image ? $post->featured_image['path'] : '' }}" alt="">
    </div>

    <div>
        {!! nl2br($post->content) !!}

    </div>
</div>