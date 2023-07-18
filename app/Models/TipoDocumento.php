<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'tid_name'
    ];

    public function usuarios(){
        return $this->hasMany(Usuario::class, 'tid_id');
    }
}
