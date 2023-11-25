<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Client;

class RegisterController extends Controller
{
    //
    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'username' => 'required|max:50|string',
            'email' => 'required|email',
            'gender' => 'required|in:male,female|string',
            'password' => 'required|string',
            'confirm_password' => 'required|string|same:password'
        ]);

        if($validator->fails()){
            $errors = $validator->errors();
            return redirect('register')->withErrors($errors);
        }else{
            $input = [
                'name' => $request->username,
                'email' => $request->email,
                'gender' => $request->gender,
                'password' => bcrypt($request->password),
            ];

            Client::create($input);

            return redirect('sign-in')->with('status', 'Registration Success!');
        }
    }
}
