<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\HttpCache\Store;

class ImageUpload extends Component
{
    use WithFileUploads;

    public $image = [];

    public function save()
    {
        $this->validate([
            'image.*' => 'required|image|max:1024', // 1MB max
        ]);

        if(count($this->image) > 0) {
            foreach($this->image as $image) {
                $image->store('public');
            }

            session()->flash('message', 'Image uploaded successful.');
        } else {
            session()->flash('warning', 'Image uploaded unsuccessful.');
        }

        // $this->image->storeAs('pbulic', $this->image->getClientOriginalName());

        $this->image = [];
    }

    public function render()
    {
        return view('livewire.image-upload', [
            'images' => collect(Storage::files('public'))
                        ->filter(function($file) {
                            return in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), ['png', 'jpg', 'jpeg', 'gif', 'webp']);
                        })
                        ->map(function($file) {
                            return Storage::url($file);
                        })
        ]);
    }
}
