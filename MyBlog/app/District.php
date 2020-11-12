<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    function province()
    {
        return $this->belongsTo('App\Province');
    }
    function wards()
    {
        return $this->hasMany('App\Ward');
    }
}
