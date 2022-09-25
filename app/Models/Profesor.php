<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    use HasFactory;
    protected $table = 'profesors';
    public $timestamps = true;

    protected $fillable = [
        'nombres',
        'apellidos',
        'fecha_nacimiento',
        'telefono',
        'email',
        'dpi',
        'direccion',
        'id_usuario',
        'created_at'
    ];
    public function profesorEstablecimiento()
    {
        return $this->belongsToMany(Establecimiento::class);
    }
    
}

