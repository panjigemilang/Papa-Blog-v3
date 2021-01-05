<?php

namespace App\Http\Controllers;

use App\Post;
use App\Tag;
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

        $criteria = Post::with('tags', 'pictures')->orderBy('created_at', 'DESC')
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

    public function searchPost($title, $num)
    {        
        try {
            $criteria = Post::with('tags')->orderBy('created_at', 'DESC')
                ->where('title', 'LIKE', "%" . $title . "%")
                ->paginate($num);
    
                $status = "success";
                $code = 200;
                $message = "posts data found";
                $data = $criteria;
    
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' => $data
            ], $code);
        } catch (\Throwable $th) {
            return response()->json([
                $status => "error",
                $data => [],
                $message => $th->getMessage()
            ], 404);
        }
    }

    public function searchPostByTag($tags, $num)
    {
        $status = "error";
        $data = [];
        $code = 404;
        $message = "posts data not found";

        $criteria = Tag::with('posts')->orderBy('created_at', 'DESC')
                ->where('tags', 'LIKE', "%" . $tags . "%")
                ->paginate($num);

        if (sizeof($criteria) != 0) {
            $status = "success";
            $code = 200;
            $message = "tags data found";
            $data = $criteria;
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $code);
    }
}
