<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException as JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException as TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException as TokenInvalidException;

// Models
use App\Models\Auth\Admin;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $req)
    {
        if (Admin::where('email', $req->email)->exists()) {
            $response = response([
                'data' => $req->password,
                'message' => 'Password salah!'
            ]);

            // Get the password from DB
            $password = Admin::where('email', $req->email)->first()->value('password');

            if (Hash::check($req->password, $password)) {
                // The passwords match...
                $credentials = $req->only('email', 'password');

                try {
                    $token = JWTAuth::attempt($credentials);

                    if (!$token) {
                        $response = response()->json(['error' => 'invalid_credentials'], 400);
                    }
                } catch (JWTException $e) {
                    $response = response()->json(['error' => 'could_not_create_token'], 500);
                }

                $response = response()->json([
                    "message" => "Login berhasil!",
                    "token" => $token
                ], 200);
            }

            return $response;
        } else {
            return response()->json([
                'data' => $req->email,
                'message' => 'User tidak ditemukan!'
            ], 400);
        }
    }

    public function getAuthenticatedUser()
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();

            if (!$user) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (TokenExpiredException $e) {
            return response()->json(['token_expired'], 501);
        } catch (TokenInvalidException $e) {
            return response()->json(['token_invalid'], 400);
        } catch (JWTException $e) {
            return response()->json(['token_absent'], 401);
        }

        return response()->json(compact('user'));
    }
}
