<?php

namespace App\Http\Controllers;

use App\Models\Comercio;
use Illuminate\Http\Request;

class ComercioController extends Controller
{
    public function index(Request $request)
    {
        // Obtener el tipo de comercio desde la solicitud
        $tipoComercioId = $request->input('tipo_comercio_id');

        // Verificar si se proporcionó el tipo de comercio
        if ($tipoComercioId) {
            // Obtener los comercios según el tipo de comercio
            $comercios = Comercio::whereHas('tipoComercio', function ($query) use ($tipoComercioId) {
                $query->where('tic_id', $tipoComercioId);
            })->get();
        } else {
            // Obtener todos los comercios si no se proporcionó un tipo de comercio
            $comercios = Comercio::get();
        }

        return $comercios;
    }
}
