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
                @error('title') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="mb-5">
                <x-label for="content" value="{{ __('Content') }}" />
                <x-textarea id="content" class="block mt-1 w-full" type="text" name="content" rows="8" wire:model="content" />
                @error('content') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="mb-5">
                <x-label for="featured_image" value="{{ __('Featured Image') }}" />
                <div class="w-full mb-4">
                    <select wire:model="imageSource" class="w-full rounded border px-3 py-2">
                        <option value="url">URL</option>
                        <option value="upload">Upload</option>
                    </select>
                </div>

                @if($imageSource == 'url')
                <x-input id="imageUrl" class="block mt-1 w-full" type="text" wire:model="imageUrl" />
                @error('imageUrl') <span class="text-red-500">{{ $message }}</span> @enderror
                @else
                <input id="imageUpload" class="block mt-1 w-full" type="file" wire:model="imageUpload" />
                @error('imageUpload') <span class="text-red-500">{{ $message }}</span> @enderror

                @if ($imageUpload && !$errors->has('imageUpload'))
                <div class="text-blue-500 cursor-pointer" wire:click="$toggle('imagePreview')">Preview</div>
                @endif

                @endif
            </div>

            <div>
                <x-button class="mt-1">SUBMIT</x-button>
                @if(session('slug'))
                <x-button class="mt-1 bg-blue-500"><a href="/posts/{{ session('slug') }}">View Post</a></x-button>
                @endif
            </div>
        </form>
        <x-dialog-modal wire:model="imagePreview">
            <x-slot name="title">
                {{ __('Featured Image') }}
            </x-slot>

            <x-slot name="content">
                @if ($imageUpload && !$errors->has('imageUpload'))
                <img src="{{ $imageUpload->temporaryUrl() }}">
                @endif
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('imagePreview')" wire:loading.attr="disabled">
                    {{ __('Close') }}
                </x-secondary-button>
            </x-slot>
        </x-dialog-modal>

    </div>
</div>