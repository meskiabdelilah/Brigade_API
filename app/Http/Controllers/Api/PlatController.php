<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plat;
use Illuminate\Validation\Rule;


class PlatController extends Controller
{
    public function index(Request $request)
    {
        $plats = $request->user()->plats()->latest()->get();

        return response()->json($plats);
    }

    public function show(Request $request, $id)
    {
        $plat = $request->user()->plats()->findOrFail($id);
        return response()->json($plat);
    }

    public function store(Request $request)
    {
         $fields = $request->validate([
            'name' => 
                [
                'required',
                'max:250',
                'string',
                Rule::unique('plats')->where('user_id', $request->user()->id)
                ],
            'price' => 'required'    
        ]);

        $plat = $request->user()->plats()->create($fields);


        return response()->json([
            'message' => 'Plat created successfully',
            'data' => $plat
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $fields = $request->validate([
            'name' => 
                [
                'required',
                'max:250',
                'string',
                Rule::unique('plats')->where('user_id', $request->user()->id)->ignore($id)
                ],
            'price' => 'required'
        ]);
        $plat = $request->user()->plats()->findOrFail($id);
        $plat->update($fields);

        return response()->json([
            'message' => 'Update successfully',
            'data' => $plat
        ], 200);
    }

    public function destroy(Request $request, $id)
    {
        $plat = $request->user()->plats()->findOrFail($id);
        $plat->delete();
        return response()->json([
            'message' => 'Delete successfully',
            'data' => $plat
        ], 200);
    }
}
