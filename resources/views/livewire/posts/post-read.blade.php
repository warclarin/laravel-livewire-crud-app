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
    <div class="h-48 overflow-hidden relative">
        <img wire:click="$toggle('showFeaturedImage')" class="w-full h-full object-cover" src="{{ $post->featured_image['source'] === 'upload' ? asset('storage/' . $post->featured_image['path']) : $post->featured_image['path'] }}" alt="">
        <button class="absolute bottom-0 right-0 p-1 text-xs bg-gray-800 text-white opacity-75 hover:opacity-100">
            Click image to enlarge
        </button>
    </div>

    <div>
        {!! nl2br($post->content) !!}
    </div>

    <x-dialog-modal wire:model="showFeaturedImage">
        <x-slot name="title">
            {{ __('Featured Image') }}
        </x-slot>

        <x-slot name="content">
            <img wire:click="$toggle('showFeaturedImage')" class="w-full h-full object-cover" src="{{ $post->featured_image['source'] === 'upload' ? asset('storage/' . $post->featured_image['path']) : $post->featured_image['path'] }}" alt="">
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('showFeaturedImage')" wire:loading.attr="disabled">
                {{ __('Close') }}
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>
</div>