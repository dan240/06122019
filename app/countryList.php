<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class countryList extends Model {
    public function region() {
        return $this->belongsTo('App\RegionName', 'region_id');
    }
}
