<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\DrugCategory;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class DrugCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all drug categories
        $drug_categories = DrugCategory::all();
        return response()->json($drug_categories, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate details
        $validator = Validator::make($request->all(), [
            'category_name' => 'string|required|max:40',
        ]);

        if($validator->fails()){
            return response()->json([
                "status" => 422,
                "errors" => $validator->errors(),
            ], 422);
        }else{
            $drug_category = new DrugCategory();
            $drug_category->category_name = $request->category_name;
            $drug_category->save();

            return response()->json([
                "status" => 200,
                "message" => "Drug category created successfully."
            ], 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Get drug category by id
        $drug_category = DrugCategory::find($id);
        if(empty($drug_category)){
            return response()->json([
                "status" => 404,
                "message" => "Drug category not found.",
            ], 404);
        }else{
            return response()->json($drug_category, 200);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if(DrugCategory::where('id', $id)->exists()){
            $validator = Validator::make($request->all(), [
                'category_name' => 'string|max:40',
            ]);

            if($validator->fails()){
                return response()->json([
                    "status" => 422,
                    "errors" => $validator->errors(),
                ], 422);
            }else{
                $drug_category = DrugCategory::find($id);
                if(!empty($request->category_name)){
                    $drug_category->category_name = $request->category_name;
                }
                $drug_category->save();

                return response()->json([
                    "status" => 200,
                    "message" => "Drug category updated successfully."
                ], 200);
            }
        }else{
            return response()->json([
                "status" => 404,
                "message" => "Drug category not found.",
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(DrugCategory::where('id', $id)->exists()){
            $drug_category = DrugCategory::find($id);
            $drug_category->delete();

            return response()->json([
                "status" => 200,
                "message" => "Drug category deleted successfully."
            ], 200);
        }else{
            return response()->json([
                "status" => 404,
                "message" => "Drug category not found.",
            ], 404);
        }
    }
}
