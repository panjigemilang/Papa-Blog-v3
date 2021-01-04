<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "tags";
    protected $fillable = ['tags', 'created_at', 'updated_at'];

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_tags');
    }
}
