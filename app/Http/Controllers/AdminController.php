<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function createPost(Request $request)
    {
        $status = "error";
        $data = [];
        $code = 403;
        $message = [];

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            foreach ($errors->get('title') as $msg) {
                $message['title'] = $msg;
            }

            foreach ($errors->get('content') as $msg) {
                $message['content'] = $msg;
            }
        } else {
            $post = Post::create([
                'title' => $request->title,
                'content' => $request->content,
            ]);

            if ($post) {
                $status = "success";
                $message = "post added successfully";
                $data = $post->toArray();
                $code = 201;
            } else {
                $message['error'] = 'post failed to add';
            }
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    public function editPost(Request $request, $id)
    {
        $status = "error";
        $data = [];
        $code = 403;
        $message = [];

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            foreach ($errors->get('title') as $msg) {
                $message['title'] = $msg;
            }

            foreach ($errors->get('content') as $msg) {
                $message['content'] = $msg;
            }
        } else {
            $post = Post::find($id);
            if (!is_null($post)) {
                $post->title = $request->title;
                $post->content = $request->content;
                $post->save();

                $status = "success";
                $message = "post updated successfully";
                $data = $post->toArray();
                $code = 200;
            } else {
                $message = "Error, post not found";
                $code = 404;
            }
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    public function deletePost($id)
    {
        $status = "error";
        $code = 403;
        $message = "";

        $post = Post::find($id);
        if (!is_null($post)) {
            $post->delete();

            $status = "success";
            $message = "post deleted successfully";
            $code = 200;
        } else {
            $message = "Error, post not found";
            $code = 404;
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
        ], $code);
    }
}
