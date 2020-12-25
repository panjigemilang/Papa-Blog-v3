<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Model;

class Pictures extends Model
{
    protected $fillable = [
        'post_id', 'img_path', 'created_at', 'updated_at'
    ];
}
