<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Firebase\JWT\JWT;
use Auth;

class LoginController extends Controller
{
    public function index(Request $request)
    { 
        $users = User::all();
        return response()->json($users);
    }

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
        $result = array(
            "email" => $request['email'],
            "password" => $request['password']
        );
        return response()->json($result, 201);
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
        $result = array(
            "email" => $request['email'],
            "password" => $request['password'],
            "access_token" => $token
        );
        return response()->json($result, 200);
    }
}
