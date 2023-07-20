<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use App\Models\Rol;
use App\Models\TipoDocumento;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Cache::remember('usuarios', 60, function () {
            return Usuario::with(['tipoDocumento', 'rol', 'estado'])->get();
        });

        return response()->json($usuarios);
    }

    public function local()
    {
        $usuarios = Usuario::whereHas('rol', function ($query) {
            $query->where('rol_name', 'LOCAL_OWNER');
        })->with(['tipoDocumento', 'rol', 'estado'])->get();
        return $usuarios;
    }

    public function show($id)
    {
        $usuario = Cache::remember('usuario_' . $id, 60, function () use ($id) {
            return Usuario::with(['tipoDocumento', 'rol', 'estado'])->find($id);
        });

        return response()->json($usuario);
    }

    public function store(Request $request)
    {
        try {
            $usuario = new Usuario();
            $usuario->usu_nombre = $request->usu_nombre;
            $usuario->usu_apellido = $request->usu_apellido;
            $usuario->usu_documento = $request->usu_documento;
            $usuario->usu_email = $request->usu_email;
            $usuario->usu_password = $request->usu_password;
            $usuario->tipo_documento_id = $request->tipo_documento['tid_id'];
            $usuario->rol_id = $request->rol['rol_id'];
            $usuario->estado_id = $request->estado['est_id'];
            $usuario->save();

            $usuario->load(['tipoDocumento', 'rol', 'estado']);

            return response()->json(['message' => 'Usuario creado exitosamente', 'usuario' => $usuario], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al crear el usuario', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $usuario = Usuario::findOrFail($id);
            $usuario->update([
                'usu_nombre' => $request->usu_nombre,
                'usu_apellido' => $request->usu_apellido,
                'usu_documento' => $request->usu_documento,
                'usu_email' => $request->usu_email,
                'usu_password' => $request->usu_password,
                'tipo_documento_id' => $request->tipo_documento['tid_id'],
                'rol_id' => $request->rol['rol_id'],
                'estado_id' => $request->estado['est_id']
            ]);

            return response()->json(['message' => 'Usuario actualizado exitosamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al actualizar el usuario', 'error' => $e->getMessage()], 500);
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->only(['usu_email', 'usu_password']);

        $user = Usuario::join('rols', 'usuarios.rol_id', '=', 'rols.rol_id')
            ->select('usuarios.usu_id','usuarios.usu_nombre', 'rols.rol_name')
            ->where('usu_email', $credentials['usu_email'])
            ->where('usu_password', $credentials['usu_password'])
            ->first();
        if ($user) {
            return response()->json(['user' => $user], 200);
        } else {
            return response()->json(['message' => 'Credenciales inválidas'], 401);
        }
    }
}