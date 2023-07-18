<?php

namespace App\Http\Controllers;

use App\Models\TipoComercio;
use Illuminate\Http\Request;

class TipoComercioController extends Controller
{
    public function index(){
        return TipoComercio::get();
    }
}
