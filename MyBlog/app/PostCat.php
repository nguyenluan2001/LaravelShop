<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostCat extends Model
{
    protected $fillable=['title','slug'];
    function PostSubCats()
    {
        return $this->hasOne('App\PostSubCat');
    }
}
