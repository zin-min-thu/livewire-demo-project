<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Continent;
use App\Models\Country;

class CascadingDropdown extends Component
{
    public $continents = [], $countries = [];
    public $selectedContinent, $selectedCountry;

    public function mount()
    {
        $this->continents = Continent::orderBy('name', 'asc')->get();
    }

    public function render()
    {
        return view('livewire.cascading-dropdown');
    }

    public function changeContinent()
    {
        sleep(1);

        if($this->selectedContinent !== '-1') {
            $this->countries = Country::where('continent_id', $this->selectedContinent)->orderBy('name', 'asc')->get();
        }
    }
}
