<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function login(Request $request) {

        if(Auth::attempt($request->all())) {
            $token = $request->user()->createToken('login_token');

            return ['token' => $token->plainTextToken];
        }else {
            return [
                'message' => 'User not found'
            ];
        }

    }
}
