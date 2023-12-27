<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        try {
            if(! $token = JWTAuth::attempt($credentials)) {
                return Response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return Response()->json(['message' => 'could_not_create_token', 500]);
        }

        $user = JWTAuth::user();

        return response()->json([
            'success' => true,
            'message' => 'Login Sukses',
            'token' => $token,
            'user' => $user,
        ]);
    }

    public function loginCheck()
    {
        try {
            if(! $user = JWTAuth::parseToken()->authenticate()) {
                return Response()->json(['message' => 'Invalid Token']);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return Response()->json(['message' => 'Token Expired']);
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return Response()->json(['message' => 'Token Invalid']);
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return Response()->json(['message' => 'Token Absent']);
        }

        return Response()->json([
            'success' => true,
            'message' => 'Authentication Success!',
        ]);
    }

    public function logout(Request $request)
    {
        if (JWTAuth::invalidate(JWTAuth::getToken())) {
            return Response()->json(['message' => 'Anda Sudah Logout']);
        } else {
            return Response()->json(['message' => 'Gagal Logout']);
        }
    }
}
