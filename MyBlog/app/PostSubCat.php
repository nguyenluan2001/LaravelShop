<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostSubCat extends Model
{
    protected $fillable=['title','slug','cat_id'];
    function PostCat()
    {
        return $this->belongsTo('App\PostCat');
    }
}
