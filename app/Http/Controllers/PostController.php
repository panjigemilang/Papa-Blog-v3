<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function getPosts($num)
    {
        $status = "error";
        $data = [];
        $code = 404;
        $message = "posts data not found";

        $criteria = Post::paginate($num);
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

    public function getPost($id)
    {
        $status = "error";
        $data = [];
        $code = 404;
        $message = "post data not found";

        $criteria = Post::where('id', $id)->get();
        if (sizeof($criteria) != 0) {
            $status = "success";
            $code = 200;
            $message = "post data found";
            $data = $criteria->toArray();
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
}
