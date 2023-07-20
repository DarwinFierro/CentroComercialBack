<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

class Usuario extends Model implements Authenticatable
{
    use HasFactory, AuthenticatableTrait;
    
    public $timestamps = false;
    protected $primaryKey = 'usu_id';
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

    protected $hidden = [
        'tid_id',
        'rol_id',
        'est_id'
    ];
    public function tipoDocumento()
    {
        return $this->belongsTo(TipoDocumento::class, 'tid_id', 'tid_id');
    }

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id', 'rol_id');
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'est_id', 'est_id');
    }
}