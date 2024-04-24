<?php

namespace App\Http\Controllers;

use App\Models\Ciudades;
use Illuminate\Http\Request;

class CiudadesController extends Controller
{

    public function index()
    {
        $ciudades = Ciudades::all();
        return response()->json($ciudades);
    }


    public function store(Request $request)
    {
        $rules = ['ciudad' => 'required|string|min:1|max:100'];
        $validator = \Validator::make($request->input(),$rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ],400);
        }
        $ciudades = new Ciudades($request->input());
        $ciudades->save();
        return response()->json([
            'status' => true,
            'message' => 'Ciudad guardada con éxito'
        ],200);
    }

    public function show(Ciudades $ciudades)
    {
        return response()->json([
            'status' => true,
            'data' => $ciudades
        ]);
    }
    public function update(Request $request, Ciudades $ciudades)
    {
        $rules = ['ciudad' => 'required|string|min:1|max:100'];
        $validator = \Validator::make($request->input(),$rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ],400);
        }
        $ciudades->update($request->input());
        return response()->json([
            'status' => true,
            'message' => 'Ciudad actualizada con éxito'
        ],200);
    }



    public function destroy(Ciudades $ciudades)
    {
        $ciudades->delete();
        return response()->json([
            'status' => true,
            'message' => 'Ciudad eliminada con éxito'
        ],200);
    }
}
