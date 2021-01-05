<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Model;

class PostTag extends Model
{
    protected $table = "post_tags";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['post_id', 'tag_id'];
}
