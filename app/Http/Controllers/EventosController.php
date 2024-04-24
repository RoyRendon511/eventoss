<?php

namespace App\Http\Controllers;

use App\Models\Eventos;
use App\Models\Ciudades;
use DB;
use Illuminate\Http\Request;

class EventosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $eventos = Eventos::select('eventos.*', 'ciudades.ciudades as ciudad')
            ->join('ciudades', 'ciudades.id', '=', 'eventos.ciudad_id')
            ->paginate(10);
        return response()->json($eventos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'nombre' => 'required|string|min:1|max:100',
            'descripcion' => 'required|string|min:1|max:100',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'ciudad_id' => 'required|numeric'
        ];
        $validator = \Validator::make($request->input(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        }
        $eventos = new Eventos($request->input());
        $eventos->save();
        return response()->json([
            'status' => true,
            'message' => 'Evento guardado con éxito'
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Eventos $eventos)
    {
        return response()->json([
            'status' => true,
            'data' => $eventos
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Eventos $eventos)
    {
        $rules = [
            'nombre' => 'required|string|min:1|max:100',
            'descripcion' => 'required|string|min:1|max:100',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'ciudad_id' => 'required|numeric'
        ];
        $validator = \Validator::make($request->input(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        }
        $eventos->update($request->input());
        return response()->json([
            'status' => true,
            'message' => 'Evento actualizado con éxito'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Eventos $eventos)
    {
        $eventos->delete();
        return response()->json([
            'status' => true,
            'message' => 'Evento eliminado con éxito'
        ], 200);
    }
    public function eventosPorCiudad($ciudad_id)
    {
        $eventos = Eventos::select('eventos.*', 'ciudades.ciudad as ciudad')
            ->join('ciudades', 'ciudades.id', '=', 'eventos.ciudad_id')
            ->where('ciudades.id', $ciudad_id)
            ->paginate(10);
        return response()->json($eventos);
    }
    public function all(){
        $eventos = Eventos::select('eventos.*', 'ciudades.ciudad as ciudad')
            ->join('ciudades', 'ciudades.id', '=', 'eventos.ciudad_id')
            ->get();
            return response()->json($eventos);
    }
}
