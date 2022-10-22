<a href="{{ route('download', ['asset_id' => $asset->asset_id]) }}" class="p-2 block text-center hover:text-white border-gray-100 bg-indigo-500 text-white" title="Download Asset">
    {{ $slot }}
</a>
