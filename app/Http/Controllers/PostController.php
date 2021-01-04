<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function getPosts($num)
    {
        // $criteria = Post::orderBy('created_at', 'DESC')->paginate($num);
        $criteria = Post::with('tags', 'admin')->orderBy('created_at', 'DESC')->paginate($num);
        // $criteria = Post::all()->tags->get();

        $status = "success";
        $code = 200;
        $message = "posts data found";
        $data = $criteria;

        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    public function getPost($id)
    {
        $status = "error";
        $data = [];
        $code = 404;
        $message = "post data not found";

        $criteria = Post::with('tags')->orderBy('created_at', 'DESC')
            ->where('id', '=', $id)
            ->get();

        if (sizeof($criteria) != 0) {
            $status = "success";
            $code = 200;
            $message = "post data found";
            $data = $criteria;
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    public function searchPost($title)
    {
        $status = "error";
        $data = [];
        $code = 404;
        $message = "posts data not found";

        $criteria = DB::table('posts')
            ->select('*')
            ->where('posts.title', 'LIKE', "%" . $title . "%")
            ->orderBy('posts.id', 'DESC')
            ->get();

        if (sizeof($criteria) != 0) {
            $status = "success";
            $code = 200;
            $message = "posts data found";
            $data = $criteria->toArray();
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    // public function searchPostByTag($tags)
    // {
    //     $status = "error";
    //     $data = [];
    //     $code = 404;
    //     $message = "posts data not found";

    //     $criteria = DB::table('posts')
    //         ->join('tags', 'posts.id', 'tags.post_id')
    //         ->select('posts.*', 'tags.tags')
    //         ->where('tags.tags', 'LIKE', "%" . $tags . "%")
    //         ->orderBy('posts.id', 'DESC')
    //         ->get();

    //     if (sizeof($criteria) != 0) {
    //         $status = "success";
    //         $code = 200;
    //         $message = "posts data found";
    //         $data = $criteria->toArray();
    //     }

    //     return response()->json([
    //         'status' => $status,
    //         'message' => $message,
    //         'data' => $data
    //     ], $code);
    // }
}
