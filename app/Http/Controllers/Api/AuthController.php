<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use HasApiTokens;
    
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|max:250',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed|min:8'
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => Hash::make($fields['password'])
        ]);

        $token = $user->createToken($user->name)->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,            
        ],201);
    }
}
