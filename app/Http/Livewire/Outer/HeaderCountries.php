<?php

namespace App\Http\Livewire\Outer;

use App\Models\Country\Country;
use Livewire\Component;

class HeaderCountries extends Component
{
    public $selected = [];
    public $search;
    public $navbar;

    public function mount($navbar_id)
    {
        $this->navbar = $navbar_id;
    }

    public function render()
    {
        $receiving = Country::when(!empty($this->search), function ($q) {
            $q->where('name', 'LIKE', '%' . $this->search . '%');
        })->where('is_on_receiving', 't')->select('id', 'name', 'currency', 'iso2', 'iso3')->get();
        return view('livewire.outer.header-countries', compact('receiving'));
    }

    public function selectReceiving($json)
    {
        $this->selected = json_decode($json, true);

    }
}
