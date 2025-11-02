<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refaccion extends Model
{
     use HasFactory;

    // 🔹 Soluciona el error: especificamos el nombre correcto de la tabla
    protected $table = 'refacciones';

    protected $fillable = ['nombre','descripcion','precio_unitario','stock'];
}
