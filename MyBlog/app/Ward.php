<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    function district()
    {
        return $this->belongsTo('App\District');
    }
}
