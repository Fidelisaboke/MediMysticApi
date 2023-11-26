<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    // Admin authentication
    public function login(Request $request){
        if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])){
            /** @var \App\Models\Admin $admin **/
            $admin = Auth::guard('admin')->user();

            // Create token for admin
            $success['token'] = $admin->createToken('admin_token', expiresAt:now()->addYear())->plainTextToken;
            
            $success['expires_at'] = now()->addYear();
            
            return response()->json([
                "status" => 200,
                "message" => "Login successful.",
                "token" => $success,
                "admin" => $admin,
            ], 200);
        }else{
            return response()->json([
                "status" => 401,
                "message" => "Invalid credentials.",
            ], 401);
        }
    }
}
