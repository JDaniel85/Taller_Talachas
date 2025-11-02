<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacturaDetalle extends Model
{
    protected $fillable = [
        'factura_id','servicio_id','refaccion_id','cantidad','precio_unitario','total'
    ];

    public function factura()
    {
        return $this->belongsTo(Factura::class);
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class, 'servicio_id');
    }

    public function refaccion()
    {
        return $this->belongsTo(Refaccion::class, 'refaccion_id');
    }
}

