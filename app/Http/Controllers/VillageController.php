<?php

namespace App\Http\Controllers;

use App\Models\IndonesiaDistrict;
use App\Models\IndonesiaVillage;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class VillageController extends Controller
{
    // Get all villages
    public function index()
    {
        $perPage = 10;
        $villages = DB::table('indonesia_villages')->paginate($perPage);

        return response()->json([
            'message' => 'Success get all villages',
            'data' => $villages
        ], 200);
    }

    // Get village by id
    public function show($id)
    {
        try {
            $village = IndonesiaVillage::findOrFail($id);
            return response()->json([
                'message' => 'Success get village',
                'data' => $village
            ], 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'message' => 'Village not found',
            ], 404);
        }        
    }

    // Add a village
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => [
                'required',
                'numeric',
                'digits:10',
                Rule::unique('indonesia_villages', 'code')
            ],
            'district_code' => [
                'required',
                'numeric',
                'digits:6',
                function ($attribute, $value, $fail) {
                    if (!IndonesiaDistrict::where('code', $value)->exists()) {
                        $fail('The selected district is invalid.');
                    }
                }
            ],
            'name' => 'required',
            'meta' => [
                'required',
                function ($attribute, $value, $fail) {
                    $decodedMeta = json_decode($value, true);
                    if ($decodedMeta === null 
                        || !isset($decodedMeta['lat']) 
                        || !isset($decodedMeta['long']) 
                        || !isset($decodedMeta['pos'])) {
                            $fail('The meta field must be in the correct format. Example: {"lat":"2.9300043","long":"97.4732991","pos":"23773"}');
                        }
                }
            ]
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 400);
        }

        $village = IndonesiaVillage::create([
            'code' => $request->code,
            'district_code' => $request->district_code,
            'name' => $request->name,
            'meta' => $request->meta
        ]);

        return response()->json([
            'message' => 'Village added successfully',
            'data' => $village
        ], 201);
    }

    // Update a village
    public function update(Request $request, $id)
    {
        try {
            $village = IndonesiaVillage::findOrFail($id);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'message' => 'Village not found',
            ], 404);
        }

        if (!$request->getContent()) {
            return response()->json([
                'error' => 'Request body is not filled'
            ], 400);
        }

        $request->validate([
            'code' => [
                'numeric',
                'digits:10',
                Rule::unique('indonesia_villages', 'code')->ignore($id)
            ],
            'district_code' => [
                'numeric',
                'digits:6',
                function ($attribute, $value, $fail) {
                    if (!IndonesiaDistrict::where('code', $value)->exists()) {
                        $fail('The selected district is invalid.');
                    }
                }
            ],
            'meta' => [
                function ($attribute, $value, $fail) {
                    $decodedMeta = json_decode($value, true);
                    if ($decodedMeta === null 
                        || !isset($decodedMeta['lat']) 
                        || !isset($decodedMeta['long']) 
                        || !isset($decodedMeta['pos'])) {
                        $fail('The meta field must be in the correct format. Example: {"lat":"2.9300043","long":"97.4732991","pos":"23773"}');
                    }
                }
            ]
        ]);


        if ($request->filled('code')) {
            $village->code = $request->code;
        }
        if ($request->filled('district_code')) {
            $village->district_code = $request->district_code;
        }
        if ($request->filled('name')) {
            $village->name = $request->name;
        }
        if ($request->filled('meta')) {
            $village->meta = $request->meta;
        }
        $village->save();

        return response()->json([
            'message' => 'Village updated successfully',
            'data' => $village
        ], 200);
    }

    // Delete a village
    public function destroy($id)
    {
        try {
            $village = IndonesiaVillage::findOrFail($id);
            
            $village->delete();

            return response()->json([
                'message' => 'Village deleted successfully',
            ], 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'message' => 'Village not found',
            ], 404);
        }
    }
}
