<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Post Update') }}
    </h2>
</x-slot>

<div>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        @if (session('success'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('success') }}
        </div>
        @endif

        <form wire:submit.prevent="submit">
            <div>
                <x-label for="title" value="{{ __('Title') }}" />
                <x-input id="title" class="block mt-1 w-full" type="text" name="title" wire:model="post.title" />
                @error('post.title') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div>
                <x-label for="content" value="{{ __('Content') }}" />
                <x-textarea id="content" class="block mt-1 w-full" type="text" name="content" rows="8" wire:model="post.content" />
                @error('post.content') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div>
                <x-label for="Featured Image URL" value="{{ __('Featured Image') }}" />
                <x-input id="featured_image" class="block mt-1 w-full" type="text" name="featured_image" wire:model="post.featured_image.path" />
                @error('post.featured_image') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div>
                <x-button class="mt-1">SUBMIT</x-button>
                <x-button class="mt-1 bg-red-600 float-right focus:bg-red-600" type="button" wire:click="$toggle('confirmingPostDeletion')">DELETE</x-button>
            </div>
        </form>
    </div>

    <x-dialog-modal wire:model="confirmingPostDeletion">
        <x-slot name="title">
            {{ __('Delete Post') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete this post?') }}
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('confirmingPostDeletion')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button class="ml-3" wire:click="deletePost" wire:loading.attr="disabled">
                {{ __('Delete Post') }}
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>
</div>