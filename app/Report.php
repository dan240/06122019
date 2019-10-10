<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
	protected $table = 'reports';
    //
    public function user()
    {
        return $this->hasOne('App\User', 'id', 'userid');
    }
    public function investorDetail(){
        return $this->hasOne('App\UserInvestor', 'userid', 'for_user_id');
    }

    public function companyDetail(){
        return $this->hasOne('App\UserCompany', 'userid', 'for_user_id');
    }
}
