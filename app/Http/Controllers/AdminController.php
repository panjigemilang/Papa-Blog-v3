<?php

namespace App\Http\Controllers;

use App\Picture;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;

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
            'image_cover' => 'required|mimes:jpg,jpeg,png'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            foreach ($errors->get('title') as $msg) {
                $message['title'] = $msg;
            }

            foreach ($errors->get('content') as $msg) {
                $message['content'] = $msg;
            }

            foreach ($errors->get('image_cover') as $msg) {
                $message['image_cover'] = $msg;
            }
        } else {
            $imageName = time() . "image." . $request->file('image_cover')->getClientOriginalExtension();
            $path = $request->file('image_cover')->move(public_path("/img/cover"), $imageName);
            $imageUrl = "/img/cover/" . $imageName;

            $post = Post::create([
                'title' => $request->title,
                'content' => $request->content,
                'image_cover' => $imageUrl,
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
            'image_cover' => 'required|mimes:jpg,jpeg,png'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            foreach ($errors->get('title') as $msg) {
                $message['title'] = $msg;
            }

            foreach ($errors->get('content') as $msg) {
                $message['content'] = $msg;
            }

            foreach ($errors->get('image_cover') as $msg) {
                $message['image_cover'] = $msg;
            }
        } else {
            $post = Post::find($id);
            $pictures = Picture::where('post_id', $id)->get();

            if (sizeof($pictures) != 0) {
                foreach ($pictures as $pic) {
                    // unlink(public_path($pic->img_path));
                    $pic->delete();
                }
            }

            //TODO: upload image from rich text

            if (!is_null($post)) {
                unlink(public_path($post->image_cover));

                $imageName = time() . "image." . $request->file('image_cover')->getClientOriginalExtension();
                $path = $request->file('image_cover')->move(public_path("/img/cover"), $imageName);
                $imageUrl = "/img/cover/" . $imageName;

                $post->image_cover = $imageUrl;
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
        $pictures = Picture::where('post_id', $id)->get();

        if (sizeof($pictures) != 0) {
            foreach ($pictures as $pic) {
                // unlink(public_path($pic->img_path));
                $pic->delete();
            }
        }

        if (!is_null($post)) {
            unlink(public_path($post->image_cover));
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
