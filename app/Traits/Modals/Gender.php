<?php

namespace App\Traits\Modals;

use App\Models\Options\Option;

trait Gender
{
    public $gr_search = true;
    public $gr_search_query;
    public $gr_data = [];
    public $gr_selected_data;
    public $gr_title = 'Choose Gender';


    public function grOpenModel($array, $search_flag = '1')
    {
        $this->gr_selected_data = $array;
        if (empty($search_flag)) {
            $this->gr_search = false;
        }
        $this->grFetchData();
        $this->dispatchBrowserEvent('open-modal', ['model' => 'genders-modal']);
    }

    public function grFetchData()
    {
        $this->gr_data = [
            'm', 'f'
        ];
    }

    public function updatedGrSearchQuery($value)
    {
        $this->grFetchData();
    }

    public function grSelection($json)
    {
        $data = ($json);
        if (!empty($data)) {
            $this->{$this->gr_selected_data} = $data;
        }

        $this->reset(['gr_selected_data', 'gr_search_query', 'gr_search']);
        $this->dispatchBrowserEvent('close-modal', ['model' => 'genders-modal']);
    }
}
