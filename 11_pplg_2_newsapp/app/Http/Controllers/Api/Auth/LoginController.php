<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;  // untuk validasi data
use Tymon\JWTAuth\Facades\JWTAuth;  // untuk mendapatkan token JWT
use App\Models\User;

class LoginController extends Controller
{
    public function index(Request $request){
        // set validasi
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // respon error validasi
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // get (ambil) "email" dan "password" dari input
        $credentials = $request->only('email', 'password');

        // cek jika "email" dan "password" TIDAK SESUAI
        if (!$token = auth()->guard('api')->attempt($credentials)) {
            // respon jika login failed dikarenakan email atau password salah
            return response()->json([
                'success' => false,
                'message' => 'Email or Password is incorrect.',
            ], 400);
        }

        // respon jika login success dengan generate token
        return response()->json([
            'success' => true,
            'user' => auth()->guard('api')->user()->only(['name', 'email']),
            'permissions' => auth()->guard('api')->user()->getPermissionArray(),
            'token' => $token,
        ], 200);
    }

    public function logout(){
        // remove token JWT
        JWTAuth::invalidate(JWTAuth::getToken());

        // response success logout
        return response()->json([
            'success' => true,
        ], 200);
    }
}
