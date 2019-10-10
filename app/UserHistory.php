<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserHistory extends Model
{
    //
	protected $table ='user_history';

	public function user(){
        return $this->hasOne('App\User', 'id', 'userid');
    }

	public function investorDetail(){
        return $this->hasOne('App\UserInvestor', 'userid', 'visit_id');
    }

    public function companyDetail(){
        return $this->hasOne('App\UserCompany', 'userid', 'visit_id');
    }
}
