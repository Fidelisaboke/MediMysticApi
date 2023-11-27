<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Drug;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DrugController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($client_id = null)
    {
        if($client_id !== null){
            // List of drugs purchased by a user
            $drugs = DB::table('drugs')
                ->join('invoices', 'drugs.id', '=', 'invoices.drug_id')
                ->join('clients', 'invoices.client_id', '=', 'clients.id')
                ->select('drugs.id', 'drugs.name', 'clients.name')
                ->where('clients.id', $client_id)
                ->get();
            return response()->json($drugs);
        }else{
            $drugs = Drug::all();
            return response()->json($drugs);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'drug_category_id' => 'required|integer',
            'trade_name' => 'required|string', 
            'drug_formula' => 'required|string', 
            'quantity' => 'required|integer|min:1', 
            'dosage_mg' => 'required|integer|min:1', 
            'drug_price' => 'required|numeric|min:1',
            'expiry_date' => 'required|date',
        ]);

        if($validator->fails()){
            return response()->json([
                "status" => 422,
                "errors" => $validator->errors(),
            ], 422);
        }else{

            // Check if drug category exists before creating drug
            $drug_category = DB::table('drug_categories')->where('id', $request->drug_category_id)->first();
            if(empty($drug_category)){
                return response()->json([
                    "status" => 404,
                    "message" => "Drug category not found.",
                ], 404);
            }else{
                $drug = new Drug();
                $drug->drug_category_id = $request->drug_category_id;
                $drug->trade_name = $request->trade_name;
                $drug->drug_formula = $request->drug_formula;
                $drug->quantity = $request->quantity;
                $drug->dosage_mg = $request->dosage_mg;
                $drug->drug_price = $request->drug_price;
                $drug->expiry_date = $request->expiry_date;

                $drug->save();

                return response()->json([
                    "status" => 201,
                    "message" => "Drug added successfully",
                ]);

            }
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $drug = Drug::find($id);
        if(!empty($drug)){
            return response()->json($drug);
        }

        else{
            response()->json([
                "status" => 404,
                "message"=> "Drug not found.",
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        if(Drug::where('id', $id)->exists()){
            $validator = Validator::make($request->all(), [
                'drug_category_id' => 'integer',
                'trade_name' => 'string', 
                'drug_formula' => 'string', 
                'quantity' => 'integer|min:1', 
                'dosage_mg' => 'integer|min:1', 
                'drug_price' => 'numeric|min:1',
                'expiry_date' => 'date',
            ]);
    
            if($validator->fails()){
                return response()->json([
                    "status" => 422,
                    "errors" => $validator->errors(),
                ], 422);
            }else{

                $drug = Drug::find($id);
                // Check if drug category exists

                if($request->drug_category_id !== null){
                    $drug_category = DB::table('drug_categories')->where('id', $request->drug_category_id)->first();
                    if(empty($drug_category)){
                        return response()->json([
                            "status" => 404,
                            "message" => "Drug category not found.",
                        ], 404);
                    }else{
                        $drug->drug_category_id = $request->drug_category_id;
                    }
                }

                $drug->trade_name = is_null($request->trade_name) ? $drug->trade_name : $request->trade_name;
                $drug->drug_formula = is_null($request->drug_formula) ? $drug->drug_formula: $request->drug_formula;
                $drug->quantity = is_null($request->quantity) ? $drug->quantity : $request->quantity;
                $drug->dosage_mg = is_null($request->dosage_mg) ? $drug->dosage_mg : $request->dosage_mg;
                $drug->drug_price = is_null($request->drug_price) ? $drug->drug_price : $request->drug_price;
                $drug->expiry_date = is_null($request->expiry_date) ? $drug->expiry_date : $request->expiry_date;

                $drug->save();

                return response()->json([
                    "status" => 202,
                    "message" => "Drug updated",
                ], 202);
            }
        }else{
            return response()->json([
                "status" => 404,
                "message" => "Drug not found."
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $drug = Drug::find($id);
        if(!empty($drug)){
            $drug->delete();

            return response()->json([
                "status" => 202,
                "message" => "Drug deleted."
            ], 202);
        }else{
            return response()->json([
                "status" => 404,
                "message" => "Drug not found."
            ], 404);
        }
    }


    // Additional methods
    public function indexByDrugCategory(string $id)
    {
        // Get all drugs in a particular drug category using a JOIN query
        $drugs = DB::table('drugs')
            ->join('drug_categories', 'drugs.drug_category_id', '=', 'drug_categories.id')
            ->select('drugs.*', 'drug_categories.category_name')
            ->where('drug_categories.id', $id)
            ->get();

        return response()->json($drugs);
    }
}
