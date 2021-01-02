<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
<<<<<<< HEAD
    protected $fillable = ['admin_id', 'title', 'content', 'image_cover'];
=======
    protected $fillable = ['title', 'content', 'image_cover', 'admin_id'];
>>>>>>> ead2849bc064ab5d709927f1cd82bf645d6e18e4
}
