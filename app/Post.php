<?php

namespace App;

use App\Models\Auth\Admin;
use App\Models\Post\Pictures;
use App\Models\Post\PostTag;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['admin_id', 'title', 'content', 'image_cover'];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function pictures()
    {
        return $this->hasMany(Pictures::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tags');
    }
}
