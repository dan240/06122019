<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function inboxuser()
    {
        return $this->hasOne('App\User', 'id', 'sender_id');
    }
    public function outboxuser()
    {
        return $this->hasOne('App\User', 'id', 'reciever_id');
    }
    public function sender()
    {
    	return $this->hasOne('App\User', 'id', 'sender_id');	
    }
    public function reciever()
    {
    	return $this->hasOne('App\User', 'id', 'reciever_id');	
    }
    
    public function inboxImgComp(){
        return $this->hasOne('App\UserCompany','userid','sender_id');
    }
    public function inboxImgInv(){
        return $this->hasOne('App\UserInvestor','userid','sender_id');
    }
    
    public function outboxImgComp(){
        return $this->hasOne('App\UserCompany','userid','reciever_id');
    }
    public function outboxImgInv(){
        return $this->hasOne('App\UserInvestor','userid','reciever_id');
    }
    
    /* public function CompanyDataInbox()
    {
        return $this->hasOne('App\UserCompany','userid','reciever_id');
    }
    public function InvestorDataOutbox()
    {
        return $this->hasOne('App\UserInvestor','userid','sender_id');
    }*/
}
