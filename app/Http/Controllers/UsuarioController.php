<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::all();
        return $usuarios;
    }

    public function store(Request $request)
    {
        $usuario = new Usuario();
        $usuario->usu_nombre = $request->input('usu_nombre');
        $usuario->usu_apellido = $request->input('usu_apellido');
        $usuario->usu_documento = $request->input('usu_documento');
        $usuario->usu_email = $request->input('usu_email');
        $usuario->usu_password = $request->input('usu_password');
        $usuario->tid_id = $request->input('tid_id');
        $usuario->rol_id = $request->input('rol_id');
        $usuario->est_id = $request->input('est_id');
        $usuario->save();

        return $usuario;
    }
}
