<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comercio extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'com_nombre',
        'tic_id'
    ];
    public function tipoComercio()
    {
        return $this->belongsTo(TipoComercio::class, 'tic_id', 'tic_id');
    }

}
