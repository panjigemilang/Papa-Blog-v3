<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
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
        if (!empty($req->image_files)) {
            // add post before add images to get the post_id
            try {
                $post = Post::create([
                    'title' => $req->title,
                    'content' => $req->content 
                ]);

                try {
                    // public folder to store image
                    $folder = 'img/';

                    foreach ($req->image_files as $image) { 
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
                $post = Post::create([
                    'title' => $req->title,
                    'content' => $req->content
                ]);

                $response = $this->responseSuccess($post);

            } catch (\Throwable $th) {
                $response = $this->responseError($th, 'error saat memasukkan post!');   
            }
        }
        
        return $response;
    }

    public function editPost(Request $req)
    {
        // @unlink(public_path('img/').'1608890588.png');
    }

    public function getAllPosts()
    {
        // $posts = DB::table('posts AS p')
        //             ->leftJoin('pictures AS pi', 'p.id', 'pi.post_id')
        //             ->select('p.*', 'pi.img_path')
        //             ->get();
        $posts = Post::take(10)->get();

        $response = $this->responseSuccess($posts);

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
