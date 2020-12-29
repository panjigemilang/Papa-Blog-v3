<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// Models
use App\Models\Post\Post;
use App\Models\Post\Pictures;

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
                    $folder = 'img/';
                    // convert string to array
                    $image_files = explode(' ', $req->image_files);

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

                $response = $this->responseSuccess($post);

            } catch (\Throwable $th) {
                $response = $this->responseError($th, 'error saat memasukkan post!');   
            }
        }
        
        return $response;
    }

    public function postCreate($req)
    {
        $imageName = time() . "image." . $req->file('image_cover')->getClientOriginalExtension();
        $path = $req->file('image_cover')->move(public_path("/img/cover"), $imageName);
        $imageUrl = "img/cover/" . $imageName;
        
        $post = Post::create([
            'title' => $req->title,
            'content' => $req->content,
            'image_cover' => $imageUrl,
        ]);

        return $post;
    }
    
    public function getPosts($num)
    {
        $criteria = Post::paginate($num);
        return new PostResource($criteria);
    }

    public function getPost($id)
    {
        $criteria = Post::where('id', $id)->get();
        return new PostResource($criteria);
    }

    public function searchPost($title)
    {
        $criteria = DB::table('posts')
            ->select('*')
            ->where('posts.title', 'LIKE', "%" . $title . "%")
            ->orderBy('posts.id', 'DESC')
            ->get();
        return new PostResource($criteria);
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
