<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function login(Request $request){
        $request->validate([
           'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        
        try {
            $User = User::create([
                "email" => $request->input('email'),
                "password" => $request->input('password')
    
            ]);
            return response()->json([$User,200]);
        } catch (\Throwable $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'Something went wrong'], 500);
        }

        
    }
        public function logout(Request $request){
        // Your code here
    }
        public function callback(Request $request){
        // Your code here
    }
}
