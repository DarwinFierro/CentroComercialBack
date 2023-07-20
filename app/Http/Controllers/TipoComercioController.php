<?php

namespace App\Http\Controllers;

use App\Models\TipoComercio;

class TipoComercioController extends Controller
{
    public function index(){
        return TipoComercio::get();
    }
}
