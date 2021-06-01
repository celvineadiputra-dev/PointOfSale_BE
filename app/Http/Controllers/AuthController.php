<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\ResponseJson;
use App\Http\Resources\AuthResource;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => "required",
            'email' => "required|email|unique:users",
            'password' => "required",
            "password_confirm" => "required|same:password"
        ]);
        if ($validator->fails()) {
            return ResponseJson::error($validator->errors());
        }

        try {
            $request['password'] = Hash::make($request->password);
            $user = User::create($request->all());
            $user['token'] = $user->createToken('M4sterTh1ng')->plainTextToken;
            return ResponseJson::success(new AuthResource($user), 'User berhasil di register');
        } catch (Exception $e) {
            return ResponseJson::error($e->getMessage());
        }
    }

    public function login(Request $request)
    {
        if (Auth::attempt(
            [
                'email' => $request->email,
                'password' => $request->password
            ]
        )) {
            $user = Auth::user();
            $user['token'] = $user->createToken('M4sterTh1ng')->plainTextToken;
            return ResponseJson::success(new AuthResource($user), 'Berhasil di login');
        } else {
            return ResponseJson::error("Email atau Password Tidak valid");
        }
    }
}
