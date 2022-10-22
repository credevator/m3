<div class="items-center mx-auto w-1/2 mb-6 border-gray-100 border-2 p-4">
<form action="{{ route('upload') }}" enctype="multipart/form-data" method="post">
    @csrf
    <x-jet-label for="asset" value="{{ __('Asset') }}" />
    <x-jet-input type="file" name="asset" onchange="form.submit()" accept="image/*"></x-jet-input>
</form>
</div>
