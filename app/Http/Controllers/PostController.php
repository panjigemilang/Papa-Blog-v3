<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Post;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function getPosts($num)
    {
        $criteria = Post::paginate($num);
        return new PostResource($criteria);
    }

    public function getPost($id)
    {
        $criteria = Post::where('id', $id)->get();
        return new PostResource($criteria);
    }

    public function searchPost($title)
    {
        $criteria = DB::table('posts')
            ->select('*')
            ->where('posts.title', 'LIKE', "%" . $title . "%")
            ->orderBy('posts.id', 'DESC')
            ->get();
        return new PostResource($criteria);
    }
}
