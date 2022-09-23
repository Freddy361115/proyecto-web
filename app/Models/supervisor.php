<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class supervisor extends Model
{
    use HasFactory;
    protected $table = 'supervisors';
    public $timestamps = true;

    protected $fillable = [
        'nombres',
        'apellidos',
        'dpi',
        'fecha_nacimiento',
        'email',
        'dpi',
        'direccion',
        'id_usuario',
        'created_at'
    ];
}
