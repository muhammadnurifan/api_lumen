<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Firebase\JWT\JWT;
use Auth;

class LoginController extends Controller
{
    public function register(Request $request)
    { 
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request['password']),
        ];

        $users = User::create($data);
        return response()->json($users);
    }

    public function login(Request $request)
    { 
        $validated = $this->validate($request, [
            'email' => 'required|exists:users,email',
            'password' => 'required'
        ]);

        $user = User::where('email', $validated['email'])->first();
        if(!Hash::check($validated['password'], $user->password)) {
            return response()->json("Email or Password not valid");
        }
        $payload = [
            'iat' => intval(microtime(true)),
            'exp' => intval(microtime(true)) + (60 * 60 * 100),
            'uid' => $user->_id
        ];
        $token = JWT::encode($payload, env('JWT_SECRET'));
        return response()->json(['accsess_token' => $token]);
    }
}
