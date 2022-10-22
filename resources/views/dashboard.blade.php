<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
               <h2 class="p-6 text-2xl">Assets</h2>
                <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                    <x-upload-form></x-upload-form>
                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5">
                @foreach($assets as $asset)
                    <div class="p-2 border-2 m-3 grid">
                        <a href="{{ route('edit', ['asset_id' => $asset->asset_id]) }}">
                        <img src="{{ asset($asset->path) }}" alt="{{ $asset->filename }}" class="place-items-start">
                        </a>
                        <h3>{{ $asset->filename }}</h3>
                        <div class="flex justify-center gap-1 place-items-end">
                            <a href="{{ route('download', ['asset_id' => $asset->asset_id]) }}" class="p-2 block text-center hover:text-white border-gray-100 bg-indigo-500 text-white" title="Download Asset">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                </svg>
                            </a>
                            <a href="{{ route('edit', ['asset_id' => $asset->asset_id]) }}" class="p-2 block text-center hover:text-white border-gray-100 bg-indigo-500 text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                </svg>

                            </a>
                            <a title="Delete Asset" href="{{ route('delete', ['asset_id' => $asset->asset_id]) }}" class="p-2 block text-center hover:text-white border-gray-100 bg-red-500 text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
