<div class="p-6">
    <form wire:submit.prevent="save" class="flex flex-col w-[400px] mx-auto py-16">
        @if(session('message'))
            <p class="text-green-700">{{ session('message') }}</p>
        @endif
        @if(session('warning'))
            <p class="text-red-700">{{ session('warning') }}</p>
        @endif

        @if($image)
            Preview: 
            <div class="flex flex-wrap justify-center gap-6">
                @foreach ($image as $img)
                    <img src="{{ $img->temporaryUrl() }}" alt="" class="w-[110x] h-[90px] object-cover">
                @endforeach
            </div>
        @endif

        <input type="file" wire:model="image" class="mb-4" multiple>
        <div wire:loading wire:target="image">Uploading...</div>
        @error('image')
            <span class="error">{{ $message }}</span>
        @enderror

        <button type="submit" class="py-2 px-4 bg-indigo-500 hover:bg-indigo-600 rounded text-white">Save Photo</button>
    </form>

    <div class="flex flex-wrap gap-7">
        @foreach ($images as $image)
            <img src="{{ $image }}" alt="" class="w-[128x] h-[120px] object-cover">
        @endforeach
    </div>
</div>