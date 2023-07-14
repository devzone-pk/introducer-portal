<?php

namespace App\Traits\Modals;

use App\Models\Options\Option;
use Illuminate\Support\Facades\Http;

trait Address
{
    public $ad_search = true;
    public $ad_search_query;
    public $ad_data = [];
    public $ad_selected_data;
    public $ad_title = 'Search Address';


    public function adOpenModel($array, $search_flag = '1')
    {
        $this->ad_selected_data = $array;
        if (empty($search_flag)) {
            $this->ad_search = false;
        }
        $this->adfetchData();
        $this->dispatchBrowserEvent('open-modal', ['model' => 'address-modal']);
    }

    public function adfetchData()
    {


        if (!empty($this->ad_search_query)) {
            $response = Http::get('https://maps.googleapis.com/maps/api/place/autocomplete/json', [
                'input' => $this->ad_search_query,
                'types' => 'address',
                'key' => 'AIzaSyA53c-kShqzilTOffejVfa6kqDW6aE7qrY'
            ]);
            $response = $response->json();
            $this->ad_data = $response['predictions'];
        } else {
            $this->ad_data = [];
        }


    }

    public function updatedAdSearchQuery($value)
    {
        $this->adfetchData();
    }

    public function adSelection($json)
    {
        $this->{$this->ad_selected_data} = $json;
        $this->reset(['ad_selected_data', 'ad_search_query', 'ad_search']);
        $this->dispatchBrowserEvent('close-modal', ['model' => 'address-modal']);
    }
}
