<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoComercio extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'tic_name'
    ];

    public function usuarios(){
        return $this->hasMany(Usuario::class, 'tic_id');
    }
}
