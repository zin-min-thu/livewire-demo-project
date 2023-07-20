<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;

class ProductSearch extends Component
{
    use WithPagination;

    public $search = '';

    protected $queryString = ['search'];

    public function render()
    {
        $query = Product::query();

        if($this->search) {
            $query->where('title', 'like', "%{$this->search}%")
                ->orWhere('description', 'like', "%{$this->search}%");
        }

        return view('livewire.product-search', [
            'products' => $query->paginate(10)
        ]);
    }

    public function updated($property)
    {
        if($property == 'search') {
            $this->resetPage();
        }
    }
}
