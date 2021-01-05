<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function getTags($num)
    {
        $tags = Tag::take($num)->get();

        $response = $this->responseSuccess($tags->shuffle());

        return $response;
    }

    public function responseError($th, $message = "Errors occured")
    {
        $response = response()->json([
            'status' => 'errors',
            'error_message' => $th->getMessage(),
            'note' => $message
        ], 400);

        return $response;
    }

    public function responseSuccess($data, $message = "success")
    {
        $response = response()->json([
            'status' => 'success',
            'data' => $data,
            'note' => $message
        ]);

        return $response;
    }
}
