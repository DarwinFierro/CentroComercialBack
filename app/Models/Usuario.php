<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'usu_nombre',
        'usu_apellido',
        'usu_documento',
        'usu_email',
        'usu_password',
        'tid_id',
        'rol_id',
        'est_id'
    ];
    public function tipoDocumento(){
        return $this->belongsTo(TipoDocumento::class, 'tid_id');
    }

    public function rol(){
        return $this->belongsTo(Rol::class, 'rol_id');
    }

    public function estado(){
        return $this->belongsTo(Estado::class, 'est_id');
    }

    public function local(){
        return $this->hasMany(Local::class, 'loc_id');
    }
}