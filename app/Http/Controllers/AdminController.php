<?php

namespace App\Http\Controllers;

use App\Models\Post\Pictures;
use App\Picture;
use App\Post;
use App\Tag;
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
                if (!is_null($request->tags)) {
                    Tag::create([
                        'post_id' => $post->id,
                        'tags' => $request->tags
                    ]);
                }
                
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
            'content' => 'required'
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
            $pictures = Picture::where('post_id', $id)->get();
            
            if (!is_null($post)) {
                if ($request->image_files != 'null') {
                    // TODO: upload image files from content
                    // Deleting the previous image
                    if (sizeof($pictures) != 0) {
                        foreach ($pictures as $pic) {
                            unlink(public_path($pic->img_path));
                            $pic->delete();
                        }
                    }

                    try {
                        // public folder to store image
                        $folder = '/img/';
                        // convert string to array
                        $image_files = preg_split('@(?=,data:),@', $request->image_files);

                        foreach ($image_files as $image) { 
                            // extract the extension from base64
                            $extension = explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            
                            $filename = time(). '.' . $extension;
                            // upload to public folder
                            \Image::make($image)->save(public_path($folder).$filename);

                            Pictures::create([
                                'post_id' => $post->id,
                                'img_path' => $folder . $filename
                            ]);
                        }
                        
                    } catch (\Throwable $th) {                    
                        $message = "Error when uploading image!";
                        $code = 404;
                    }
                }

                // TODO: edit tags
                try {
                    if ($request->tags != 'null') {
                        // convert string to array
                        $tags = explode(' ', $request->tags);
                        $tagVal = array();
                        
                        $tagVal['post_id'] = $id;
                        $tagVal['tags'] = $request->tags;
                        $tagVal['updated_at'] = date('Y-m-d H:i:s');
                        
                        // Check if tag exists, if not then create new column for created_at
                        $tag = Tag::where('post_id', $id)->get();

                        if (is_null($tag)) {
                            $tagVal['created_at'] = date('Y-m-d H:i:s');
                        }
                        
                        $cond = ['post_id' => $id];
                        Tag::updateOrCreate($cond, $tagVal);
                    }

                } catch (\Throwable $th) {
                    $message = "Error when inserting tag";
                    $code = 404;
                }

                
                // TODO: upload image cover 
                if (!is_null($request->file('image_cover'))) {
                    // delete existing image cover
                    unlink(public_path($post->image_cover));

                    $imageName = time() . "image." . $request->file('image_cover')->getClientOriginalExtension();
                    $path = $request->file('image_cover')->move(public_path("/img/cover"), $imageName);
                    $imageUrl = "/img/cover/" . $imageName;
    
                    $post->image_cover = $imageUrl;
                }

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
                unlink(public_path($pic->img_path));
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
