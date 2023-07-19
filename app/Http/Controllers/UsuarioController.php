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
            // Extraer los datos de usuario del request
            $usuarioData = $request->only([
                'usu_nombre',
                'usu_apellido',
                'usu_documento',
                'usu_email',
                'usu_password',
            ]);

            // Extraer los datos de las relaciones tipo_documento, rol y estado
            $tipoDocumentoData = $request->input('tipo_documento', []);
            $rolData = $request->input('rol', []);
            $estadoData = $request->input('estado', []);

            // Buscar o crear las instancias de las relaciones tipo_documento, rol y estado
            $tipoDocumento = TipoDocumento::firstOrCreate([
                'tid_id' => $tipoDocumentoData['tid_id'],
            ], $tipoDocumentoData);

            $rol = Rol::firstOrCreate([
                'rol_id' => $rolData['rol_id'],
            ], $rolData);

            $estado = Estado::firstOrCreate([
                'est_id' => $estadoData['est_id'],
            ], $estadoData);

            // Crear el nuevo usuario con las relaciones establecidas
            $usuario = new Usuario($usuarioData);
            $usuario->tipoDocumento()->associate($tipoDocumento);
            $usuario->rol()->associate($rol);
            $usuario->estado()->associate($estado);
            $usuario->save();

            // Carga las relaciones antes de devolver la respuesta
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
}