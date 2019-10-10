<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInvestor extends Model
{
    public function user()
    {
        return $this->hasOne('App\User', 'id', 'userid');
    }
    public function investorType()
    {
    	return $this->hasOne('App\InvestorType','id','investorType');
    }
    public function investmentType()
    {
    	return $this->hasOne('App\InvestmentType','id','investmentType');
    }
    public function sectorType()
    {
    	return $this->hasOne('App\SectorType','id','sectorFocus');
    }
    public function industry()
    {
        return $this->hasOne('App\SectorType','id','industryFocus');
    }
     public function countryData()
    {
        return $this->hasOne('App\countryList', 'id', 'country');
    }   
    public function cityData()
    {
        return $this->hasOne('App\CityList', 'id', 'city');
    }
    public function regionFocus()
    {
        return $this->hasOne('App\RegionName', 'id', 'regionFocus');   
    }

}
