<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResource;
use App\Http\Requests\UserLoginRequest;
class LoginController extends Controller
{
    public function login(UserLoginRequest $request)
    {    
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json([
                'status'  => 404,
                'message' => 'Model not found.'
            ]);
        }
    
        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'status'  => 404,
                'message' => 'Invalid credentials'
            ]);
        }

        return new UserResource($user);
    }
}
