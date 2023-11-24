<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Drug;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class DrugController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $drugs = Drug::all();
        return response()->json($drugs);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'trade_name' => 'required|string', 
            'drug_formula' => 'required|string', 
            'category' => 'required|string', 
            'quantity' => 'required|integer|min:1', 
            'dosage_mg' => 'required|integer|min:1', 
            'expiry_date' => 'required|date',
        ]);

        if($validator->fails()){
            return response()->json([
                "status" => 422,
                "errors" => $validator->errors(),
            ], 422);
        }else{
            $drug = new Drug();
            $drug->trade_name = $request->trade_name;
            $drug->drug_formula = $request->drug_formula;
            $drug->category = $request->drug_category;
            $drug->quantity = $request->quantity;
            $drug->dosage_mg = $request->dosage_mg;
            $drug->expiry_date = $request->expiry_date;

            $drug->save();

            return response()->json([
                "status" => 201,
                "message" => "Drug added successfully",
            ]);
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
                "message"=> "Drug Not found.",
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
                'trade_name' => 'string', 
                'drug_formula' => 'string', 
                'category' => 'string', 
                'quantity' => 'integer|min:1', 
                'dosage_mg' => 'integer|min:1', 
                'expiry_date' => 'date',
            ]);
    
            if($validator->fails()){
                return response()->json([
                    "status" => 422,
                    "errors" => $validator->errors(),
                ], 422);
            }else{
                $drug = Drug::find($id);
                $drug->trade_name = is_null($request->trade_name) ? $drug->trade_name : $request->trade_name;
                $drug->drug_formula = is_null($request->drug_formula) ? $drug->drug_formula: $request->drug_formula;
                $drug->category = is_null($request->category) ? $drug->category : $request->category;
                $drug->quantity = is_null($request->quantity) ? $drug->quantity : $request->quantity;
                $drug->dosage_mg = is_null($request->dosage_mg) ? $drug->dosage_mg : $request->dosage_mg;
                $drug->expiry_date = is_null($request->expiry_date) ? $drug->expiry_date : $request->expiry_date;

                $drug->save();

                return response()->json([
                    "status" => 202,
                    "message" => "Drug update",
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
}
