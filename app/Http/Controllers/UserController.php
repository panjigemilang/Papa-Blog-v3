<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Post;
use App\User;

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

    public function unlikePost($id)
    {
        $status = "error";
        $code = 403;
        $message = "";

        //TODO: replace with authenticated user
        $like = Like::where('user_id', 1)->where('post_id', $id)->delete();
        if ($like !== 0) {
            $status = "success";
            $message = "post unliked";
            $code = 200;
        } else {
            $message = "Error, post has not liked yet";
            $code = 403;
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
        ], $code);
    }

    public function getProfile($id)
    {
        $status = "error";
        $code = 403;
        $message = "";
        $data = [];

        $user = User::where('id', $id)->get();
        if (!is_null($user)) {
            $status = "success";
            $message = "user found";
            $data = $user->toArray();
            $code = 200;
        } else {
            $message = "Error, user not found";
            $code = 404;
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    public function editProfile(Request $request)
    {
        $status = "error";
        $data = [];
        $code = 403;
        $message = [];

        $validator = Validator::make($request->all(), [
            'username' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            foreach ($errors->get('username') as $msg) {
                $message['username'] = $msg;
            }
        } else {
            //TODO: replace with authenticated user
            $user = User::find(1);
            if (!is_null($user)) {
                $user->username = $request->username;
                $user->save();

                $status = "success";
                $message = "profile updated successfully";
                $data = $user->toArray();
                $code = 200;
            } else {
                $message = "Error, user not found";
                $code = 404;
            }
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $code);
    }
}
