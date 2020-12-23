<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

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
            // insert post
        }
    }
}
