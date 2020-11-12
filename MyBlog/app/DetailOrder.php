<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailOrder extends Model
{
    function order()
    {
        return $this->belongsTo('App\Order');
    }
}
