<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Post;

class UserController extends Controller
{
    public function likePost($id)
    {
        $status = "error";
        $data = [];
        $code = 403;
        $message = [];

        $post = Post::find($id);
        if (!is_null($post)) {
            //TODO: replace with authenticated user
            $like = Like::create([
                'user_id' => 1,
                'post_id' => $id,
            ]);

            if ($like) {
                $status = "success";
                $message = "post liked";
                $data = $post->toArray();
                $code = 200;
            } else {
                $message = "Error, post not found";
                $code = 404;
            }
        } else {
            $message = "Error, post not found";
            $code = 404;
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    public function commentPost(Request $request, $id)
    {
        $status = "error";
        $data = [];
        $code = 403;
        $message = [];

        $validator = Validator::make($request->all(), [
            'content' => 'required'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            foreach ($errors->get('content') as $msg) {
                $message['content'] = $msg;
            }
        } else {
            $comment = Comment::create([
                'post_id' => $id,
                'content' => $request->content,
            ]);

            if ($comment) {
                $status = "success";
                $message = "comment added successfully";
                $data = $comment->toArray();
                $code = 201;
            } else {
                $message['error'] = 'comment failed to add';
            }
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    public function removeComment($id)
    {
        $status = "error";
        $code = 403;
        $message = "";

        $comment = Comment::find($id);
        if (!is_null($comment)) {
            $comment->delete();

            $status = "success";
            $message = "comment deleted successfully";
            $code = 200;
        } else {
            $message = "Error, comment not found";
            $code = 404;
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
        ], $code);
    }
}
