<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    function districts()
    {
        return $this->hasMany('App\District');
    }
}
