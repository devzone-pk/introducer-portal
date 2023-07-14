<?php

namespace App\Models\Customer;


use App\Models\City;
use App\Models\Country\Country;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function country()
    {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }

    public function nationality()
    {
        return $this->hasOne(Country::class, 'id', 'nationality_country_id');
    }


    public function city()
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }
}
