<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Post;
use App\Models\Post\Pictures;
use App\Tag;
use App\Models\Post\PostTag;

class PostController extends Controller
{
    public function addPost(Request $req)
    {
        // If there are images, save it to public folder
        if ($req->image_files != 'null') {
            // add post before add images to get the post_id
            try {
                $post = $this->postCreate($req);

                try {
                    // public folder to store image
                    $folder = '/img/';
                    // convert string to array
                    $image_files = preg_split('@(?=,data:),@', $req->image_files);

                    foreach ($image_files as $image) { 
                        // extract the extension from base64
                        $extension = explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
        
                        $filename = time(). '.' . $extension;
                        // upload to public folder
                        \Image::make($image)->save(public_path($folder).$filename);

                        $picture = Pictures::create([
                            'post_id' => $post->id,
                            'img_path' => $folder . $filename
                        ]);
                    }

                    try {
                        if ($req->tags != 'null') {
                            // convert string to array
                            $tags = explode(',', $req->tags);

                            var_dump($tags);

                            foreach ($tags as $tag) { 
                                // search for the text, if exists then add the tag id
                                $temp = Tag::firstWhere('tags', $tag);

                                if ($temp) {
                                    PostTag::create([
                                        'post_id' => $post->id,
                                        'tag_id' => $temp->id
                                    ]);
                                } else {
                                    $tagVal = Tag::create([
                                        'tags' => $tag
                                    ]);
    
                                    if ($tagVal) {
                                        PostTag::create([
                                            'post_id' => $post->id,
                                            'tag_id' => $tagVal->id
                                        ]);
                                    }
                                }
                            }
                        }

                        $response = $this->responseSuccess($post);

                    } catch (\Throwable $th) {
                        $response = $this->responseError($th, 'error saat insert tag!');   
                    }

                    $response = $this->responseSuccess($post);
                    
                } catch (\Throwable $th) {                    
                    $response = $this->responseError($th, 'error saat upload image!');   
                }
            } catch (\Throwable $th) {
                $response = $this->responseError($th, 'error saat memasukkan post!');   
            }            
        } 
        // if no images
        else {
            try {
                $post = $this->postCreate($req);

                if ($req->tags != 'null') {
                    // convert string to array
                    $tags = explode(',', $req->tags);

                    foreach ($tags as $tag) { 
                        // search for the text, if exists then add the tag id
                        $temp = Tag::firstWhere('tags', $tag);

                        if ($temp) {
                            PostTag::create([
                                'post_id' => $post->id,
                                'tag_id' => $temp->id
                            ]);
                        } else {
                            $tagVal = Tag::create([
                                'tags' => $tag
                            ]);

                            if ($tagVal) {
                                PostTag::create([
                                    'post_id' => $post->id,
                                    'tag_id' => $tagVal->id
                                ]);
                            }
                        }
                    }
                }

                $response = $this->responseSuccess($post);

            } catch (\Throwable $th) {
                $response = $this->responseError($th, 'error saat memasukkan post!');   
            }
        }
        
        return $response;
    }

    public function jajal(Request $req, $id)
    {
        $post = Tag::all();
        // $post = Post::with('tags')->paginate($num);
        // $post = PostTag::with('posts')->where('post_id', '=', $id)->get();

        $response = $this->responseSuccess($post);

        return $response;
    }

    public function postCreate($req)
    {
        $imageName = time() . "image." . $req->file('image_cover')->getClientOriginalExtension();
        $path = $req->file('image_cover')->move(public_path("/img/cover"), $imageName);
        $imageUrl = "/img/cover/" . $imageName;
        
        $post = Post::create([
            'admin_id' => $req->admin_id,
            'title' => $req->title,
            'content' => $req->content,
            'image_cover' => $imageUrl,
        ]);

        return $post;
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
