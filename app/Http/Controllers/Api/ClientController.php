<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($gender = null){
        if($gender !== null){
            $clients = Client::where('gender', $gender)->get();      
        } else{
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

            try{
                $input = $request->all();

                // Encrypt the password
                $input['password'] = bcrypt($input['password']);
                
                Client::create($input);
                
                return response()->json([
                    "status" => 200,
                    "message" => "User registered successfully."
                ], 200);
            }catch(\Exception $e){
                return response()->json([
                    "status" => 500,
                    "message" => $e->getMessage()
                ], 500);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Get specific client
        try{
            $client = Client::find($id);
            if(!empty($client)){
                return response()->json($client, 200);
            }else{
                return response()->json([
                    "status" => 404,
                    "message" => "Client not found."
                ], 404);
            }
        }catch(\Exception $e){
            return response()->json([
                "status" => 500,
                "message" => $e->getMessage()
            ], 500);
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
                try{
                    $client = Client::find($id);
                    $client->name = is_null($request->name) ? $client->name : $request->name;
                    $client->email = is_null($request->email) ? $client->email : $request->email;
                    $client->gender = is_null($request->gender) ? $client->gender : $request->gender;
                    $client->save();

                    return response()->json([
                        "status"=> 200,
                        "message" => "User updated."
                    ], 200);
                }catch(\Exception $e){
                    return response()->json([
                        "status" => 500,
                        "message" => $e->getMessage()
                    ], 500);
                }
            }

        } else{
            return response()->json([
                "status" => 404,
                "message" => "Client not found"
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
                "message" => "Client not found"
            ], 404);
        }
    }

    public function indexByLastLogin(){
        $client = DB::table('clients')->latest('last_login_at')->get();
        return response()->json($client, 200);
    }

    public function indexByDrugCategory($drug_category){
        // List of all clients who have purchased a specific drug in a particular category
        $clients = DB::table('clients')
        ->join('invoices', 'clients.id', '=', 'invoices.client_id')
        ->join('drugs', 'invoices.drug_id', '=', 'drugs.id')
        ->join('drug_categories', 'drugs.drug_category_id', '=', 'drug_categories.id')
        ->select('clients.id', 'clients.name', 'drugs.trade_name', 'drug_categories.category_name')
        ->where('drug_categories.category_name', $drug_category)->get();

        return response()->json($clients, 200);
    }

    public function indexByPurchaseDate($purchase_date){
        // List of all users who purchased a drug on a particular date
        $clients = DB::table('clients')
        ->join('invoices', 'clients.id', '=', 'invoices.client_id')
        ->join('drugs', 'invoices.drug_id', '=', 'drugs.id')
        ->select('clients.id', 'clients.name', 'drugs.trade_name', 'invoices.invoice_date')
        ->where('invoices.invoice_date', $purchase_date)->get();

        return response()->json($clients, 200);
    }
}
