<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageData extends Model
{
    public function PageInfo()
    {
    	return $this->hasOne('App\StaticPage', 'id', 'page_id');
    }
}
