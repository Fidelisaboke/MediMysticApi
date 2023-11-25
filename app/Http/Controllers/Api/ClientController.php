<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($gender = null, $drug_category = null, $purchase_date = null, $last_login = null){
        if($gender !== null){
            $clients = Client::where('gender', $gender)->get();
        }else if($drug_category !== null){
            // Functionality required
            $clients = Client::where('drug_category', $drug_category);
        } else if($purchase_date !== null){
            // Functionality required
            $clients = Client::where('purchase_date', $purchase_date);
        }
         else if($last_login !== null){
            if($last_login == 1){
                $clients = Client::orderBy('last_login_at', 'asc')->get();
            }else if($last_login == 0){
                $clients = Client::orderBy('last_login_at', 'desc')->get();
            }
        }else{
            $clients = Client::all();
        }
        return response()->json($clients, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate details
        $validator = Validator::make($request->all(), [
            'name' => 'string|required|max:40',
            'email' => 'string|required|max:40',
            'gender' => 'string|in:male,female',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                "status" => 422,
                "errors" => $validator->errors(),
            ], 422);
        }else{
            $input = $request->all();

            // Encrypt the password
            $input['password'] = bcrypt($input['password']);
            
            Client::create($input);
            
            return response()->json([
                "status" => 200,
                "message" => "User registered successfully."
            ], 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Get specific client
        $client = Client::find($id);
        if(!empty($client)){
            return response()->json($client, 200);
        }else{
            return response()->json([
                "status" => 404,
                "message" => "User not found."
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        if(Client::where('id', $id)->exists()){
            // Validate details
            $validator = Validator::make($request->all(), [
                'name' => 'string|max:40',
                'email' => 'string|max:40',
                'gender' => 'string|in:male,female',
            ]);

            if($validator->fails()){
                return response()->json([
                    "status" => 422,
                    "errors" => $validator->errors(),
                ], 422);
            }else{
                $client = Client::find($id);
                $client->name = is_null($request->name) ? $client->name : $request->name;
                $client->email = is_null($request->email) ? $client->email : $request->email;
                $client->gender = is_null($client->gender) ? $client->gender : $request->gender;

                return response()->json([
                    "status"=> 200,
                    "message" => "User updated."
                ], 200);
            }

        } else{
            return response()->json([
                "status" => 404,
                "message" => "User not found"
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Delete the user
        if(Client::where('id', $id)->exists()){
            $client = Client::find($id);
            $client->delete();

            return response()->json([
                "status" => 200,
                "message" => "User deleted."
            ], 200);
        } else{
            return response()->json([
                "status" => 404,
                "message" => "User not found"
            ], 404);
        }
    }
}
