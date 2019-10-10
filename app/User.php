<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function UserProfessional()
    {
       return $this->hasOne('App\UserProfessional', 'id', 'is_Professional');
    }
    public function UserType()
    {
        return $this->hasOne('App\UserType','id','usertype');
    }

    public function investorDetail(){
        return $this->hasOne('App\UserInvestor', 'userid', 'id');
    }

    public function companyDetail(){
        return $this->hasOne('App\UserCompany', 'userid', 'id');
    }
}
