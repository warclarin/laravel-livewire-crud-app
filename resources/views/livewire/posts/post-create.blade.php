<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Post Create') }}
    </h2>
</x-slot>

<div>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        @if (session('success'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('success') }}
        </div>
        @endif

        <form wire:submit.prevent="store">
            <div class="mb-5">
                <x-label for="title" value="{{ __('Title') }}" />
                <x-input id="title" class="block mt-1 w-full" type="text" name="title" wire:model="title" />
                @error('title') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="mb-5">
                <x-label for="content" value="{{ __('Content') }}" />
                <x-textarea id="content" class="block mt-1 w-full" type="text" name="content" rows="8" wire:model="content" />
                @error('content') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="mb-5">
                <x-label for="featured_image.path" value="{{ __('Featured Image URL') }}" />
                <x-input id="featured_image.path" class="block mt-1 w-full" type="text" name="featured_image.path" wire:model="featured_image.path" />
                @error('featured_image.path') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div>
                <x-button class="mt-1">SUBMIT</x-button>
            </div>
        </form>
    </div>
</div>