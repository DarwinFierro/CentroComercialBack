<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'loc_nombre',
        'loc_telefono',
        'usu_id',
        'est_id',
        'com_id'
    ];
    public function usuario(){
        return $this->belongsTo(Usuario::class, 'usu_id');
    }

    public function estado(){
        return $this->belongsTo(Estado::class, 'est_id');
    }

    public function comercio(){
        return $this->belongsTo(Comercio::class, 'com_id');
    }

    
}
