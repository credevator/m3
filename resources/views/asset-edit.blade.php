<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Asset') }}
        </h2>
    </x-slot>

        <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
                <img src="{{ asset($asset->path) }}">

            <div class="action flex justify-end">
                <a href="{{ route('download', ['asset_id' => $asset->asset_id]) }}" class="p-2 block text-center hover:text-white border-gray-100 bg-indigo-500 text-white" title="Download Asset">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                    </svg>
                </a>
                <a title="Delete Asset" href="{{ route('delete', ['asset_id' => $asset->asset_id]) }}" class="p-2 block text-center hover:text-white border-gray-100 bg-red-500 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </a>
            </div>
            <x-jet-section-border />
            <x-jet-form-section submit="updateProfileInformation">
                <x-slot name="title">
                    {{ __('Tags') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('Manage tags related to assets.') }}
                </x-slot>

                <x-slot name="form">
                    <x-jet-label for="tags" value="Tags"></x-jet-label>
                    <x-jet-input type="text" name="tag"></x-jet-input>
                    <div class="inline">
                    @foreach($asset->tags as $tag)
                        <span class="inline">{{ $tag->name }}</span>,
                    @endforeach
                    </div>
                </x-slot>
                <x-slot name="actions">

                </x-slot>
            </x-jet-form-section>
        </div>

</x-app-layout>
