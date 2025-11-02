<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    protected $fillable = ['cliente_id','subtotal','impuestos','total','estatus'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function detalles()
    {
        return $this->hasMany(FacturaDetalle::class);
    }
}

