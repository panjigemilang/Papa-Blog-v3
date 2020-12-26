<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // table
    protected $table = 'posts';

    protected $fillable = [
        'title', 'content', 'created_at', 'updated_at'
    ];

    public function pictures()
    {
        return $this->hasMany(Pictures::class);
    }
}
