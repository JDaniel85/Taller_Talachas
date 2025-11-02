<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = ['nombre','rfc','direccion','correo','telefono'];

    public function facturas()
    {
        return $this->hasMany(Factura::class);
    }
}

