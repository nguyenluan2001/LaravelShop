<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCat extends Model
{
    function ProductSubCats()
    {
        return $this->hasOne('App\ProductSubCat');
    }
}
