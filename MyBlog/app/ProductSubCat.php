<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSubCat extends Model
{
    //
    function ProductCat()
    {
        return $this->belongsTo('App\ProductCat');
    }
}
