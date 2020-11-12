<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    function detail_orders()
    {
        return $this->hasMany('App\DetailOrder');
    }
}
