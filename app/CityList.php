<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CityList extends Model
{
    //
	protected $table ='city_lists';
	protected $fillable = ['country_id', 'city_name'];

    public function Country(){
    	return $this->hasOne('App\countryList','id', 'country_id');
    }
}
