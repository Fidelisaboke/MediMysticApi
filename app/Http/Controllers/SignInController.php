<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SignInController extends Controller
{
    // Authenticate and sign in
    public function signIn(Request $request){
        if(Auth::guard('client')->attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect('user-dashboard');
            
        }else{
            return redirect('sign-in')->withErrors(['error' => 'Invalid email or password']);
        }
    }
}
