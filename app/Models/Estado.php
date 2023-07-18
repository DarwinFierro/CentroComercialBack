<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'est_name'
    ];

    public function usuarios(){
        return $this->hasMany(Usuario::class, 'est_id');
    }
}
