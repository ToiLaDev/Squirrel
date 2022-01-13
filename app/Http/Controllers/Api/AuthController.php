<?php


namespace App\Http\Controllers\Api;


use App\Models\User;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController
{
    use ApiResponseTrait;

    public function register(Request $request)
    {
        $attr = $request->validate([
            'username' => 'required|string|max:255|unique:users,username',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed'
        ]);

        $user = User::create([
            'username' => $attr['name'],
            'first_name' => $attr['first_name'],
            'last_name' => $attr['last_name'],
            'email' => $attr['email'],
            'password' => bcrypt($attr['password'])
        ]);

        return $this->success([
            'token' => $user->createToken('API Token')->plainTextToken
        ]);
    }

    public function login(Request $request)
    {
        $attr = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string|min:6'
        ]);

        if (!Auth::attempt($attr)) {
            return $this->error('Credentials not match', 401);
        }

        return $this->success([
            'token' => Auth::user()->createToken('API Token')->plainTextToken
        ]);
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();

        return [
            'message' => 'Tokens Revoked'
        ];
    }

}