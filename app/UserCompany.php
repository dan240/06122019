<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCompany extends Model
{
    public function user()
    {
        return $this->hasOne('App\User', 'id', 'userid');
    }
    public function companyType()
    {
        return $this->hasOne('App\TypeCompanies', 'id', 'companyType');
    }

    public function TypeFunding()
    {
        return $this->hasOne('App\TypeFunding', 'id', 'fundingType');
    }        
    public function industry()
    {
        return $this->hasOne('App\Industry', 'id', 'industry');
    }        
    public function sector()
    {
        return $this->hasOne('App\SectorType', 'id', 'sector');
    }
    public function countryData()
    {
        return $this->hasOne('App\countryList', 'id', 'country');
    }   
    public function cityData()
    {
        return $this->hasOne('App\CityList', 'id', 'city');
    }           
}
