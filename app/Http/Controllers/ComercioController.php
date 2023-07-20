<?php

namespace App\Http\Controllers;

use App\Models\Comercio;
use Illuminate\Http\Request;

class ComercioController extends Controller
{
    public function index(Request $request)
    {
        $tipoComercioId = $request->input('tipo_comercio_id');
        if ($tipoComercioId) {
            return Comercio::whereHas('tipoComercio', function ($query) use ($tipoComercioId) {
                $query->where('tic_id', $tipoComercioId);
            })->get();
        } else {
            return Comercio::with('tipoComercio')->get();
        }

    }
}
