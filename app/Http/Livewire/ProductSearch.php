<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductSearch extends Component
{
    use WithPagination;

    public $search     = '';
    public $product_id = null;

    protected $queryString = [
        'search',
        'product_id',
    ];

    public $checked = [];

    public function render()
    {
        $query = Product::query();

        if ($this->search) {
            $query->where('title', 'like', "%{$this->search}%")
                ->orWhere('description', 'like', "%{$this->search}%");
        }

        return view('livewire.product-search', [
            'products' => $query->paginate(10),
        ]);
    }

    public function updated($property)
    {
        if ($property == 'search') {
            // come from withpagination trait
            $this->resetPage();
        }

        if($property == 'checked') {
            if(count($this->checked) > 0) {
                $this->product_id = implode(',', $this->checked);
                // array_push($this->queryString, 'product_id');
            } else {
                $this->product_id = null;
            }
        }
    }
}
