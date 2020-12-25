<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Post\Post;
use App\Models\Post\Pictures;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function addPost(Request $req)
    {
        $response = response()->json([
            'status' => 'success'            
        ], 200);

        // If there are images, save it to public folder
        if (!empty($req->image_files)) {
            try {
                foreach ($req->image_files as $image) { 
                    $extension = explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
    
                    $filename = time(). '.' . $extension;
    
                    \Image::make($image)->save(public_path('img/').$filename);
                }
            } catch (\Throwable $th) {
                $response = response()->json([
                    'status' => 'errors',
                    'error_message' => $th->getMessage(),
                    'note' => 'error saat upload image!'
                ], 400);
            }            
        } 
        // if no images
        else {
            try {
                $post = Post::create([
                    'title' => $req->title,
                    'content' => $req->content
                ]);

                $response = response()->json([
                    'status' => 'success',
                    'id_post' => $post->id,
                    'data' => $post
                ]);
            } catch (\Throwable $th) {
                $response = response()->json([
                    'status' => 'errors',
                    'error_message' => $th->getMessage(),
                    'note' => 'error saat memasukkan post!'
                ], 400);
            }
        }
        
        return $response;
    }

    public function editPost(Request $req)
    {
        // @unlink(public_path('img/').'1608890588.png');
    }
}
