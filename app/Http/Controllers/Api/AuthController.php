<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|string|max:255|unique:users,email',
            'phone' => 'required',
            // 'address' => 'required',
            'password' => 'required|min:8|max:20',
            'password_confirmation' => 'required|min:8|max:20|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'message' => $validator->errors(),
            ]);
        }

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->password = Hash::make($request->password);
        $user->save();

        $token = $user->createToken('my_shop')->plainTextToken;

        return response()->json([
            'status' => 1,
            'message' => 'Successfully registered',
            'data' => [
                'token' => $token,
            ],
        ]);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|string|max:255',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'message' => $validator->errors(),
            ]);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            if ($user->tokens()) {
                $user->tokens()->delete();
            }
            $token = $user->createToken('my_shop')->plainTextToken;
            return response()->json([
                'status' => 1,
                'message' => 'success',
                'data' => [
                    'token' => $token,
                ],
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'message' => 'These credentials do not match our records.',
                'data' => [null],
            ]);
        }
    }

    public function logout()
    {
        $user = Auth::user();
        if ($user->tokens()) {
            $user->tokens()->delete();
        }
        return response()->json([
            'status' => 1,
            'messge' => 'Logout success.',
        ]);
    }
}
