<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'tid_name'
    ];
    public function usuarios(){
        return $this->hasMany(Usuario::class, 'rol_id', 'rol_id');
    }
}
