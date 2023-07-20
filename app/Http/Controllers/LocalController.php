<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Local;
use App\Models\Usuario;
use App\Models\Estado;
use App\Models\Comercio;
use Illuminate\Support\Facades\Cache;

class LocalController extends Controller
{
    public function index()
    {
        return Local::whereHas('estado', function ($query) {
            $query->where('est_name', '<>', 'inactivo');
        })->with(['usuario', 'estado', 'comercio.tipoComercio'])->get();
    }

    public function show($id)
    {
        return Local::with(['usuario', 'estado', 'comercio.tipoComercio'])->find($id);
    }

    public function store(Request $request)
    {
        try {
            $local = new Local();
            $local->loc_nombre = $request->loc_nombre;
            $local->loc_telefono = $request->loc_telefono;
            $local->usu_id = $request->usuario['usu_id'];
            $local->est_id = $request->estado['est_id'];
            $local->com_id = $request->comercio['com_id'];
            $local->save();

            return response()->json(['message' => 'Local creado exitosamente', 'local' => $local], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al crear el local', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $local = Local::findOrFail($id);
            $local->update([
                'loc_nombre' => $request->loc_nombre,
                'loc_telefono' => $request->loc_telefono,
                'usu_id' => $request->usuario['usu_id'],
                'est_id' => $request->estado['est_id'],
                'com_id' => $request->comercio['com_id'],
            ]);

            return response()->json(['message' => 'Local actualizado exitosamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al actualizar el local', 'error' => $e->getMessage()], 500);
        }
    }

    public function delete($id)
    {
        $local = Local::with('estado')->find($id);
        if (!$local) {
            return response()->json(['mensaje' => 'Local no encontrado'], 404);
        }
        $estadoInactivo = $local->estado->where('est_name', 'inactivo')->first();
        if (!$estadoInactivo) {
            return response()->json(['mensaje' => 'Estado "inactivo" no encontrado'], 404);
        }
        $local->estado()->associate($estadoInactivo);
        $local->save();
        $local->touch();
        return response()->json(['mensaje' => 'Estado del local cambiado a "inactivo"']);
    }
}