<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailOrder extends Model
{
    use HasFactory;
    protected $table    = 'detail_orders';
    protected $id       = 'id';
    protected $fillable = [
        'idorden',
        'idproducto',
        'cantidad',
        'descuento',
        'igv',
        'id_afectacion_igv',
        'precio_unitario',
        'precio_total',
        'extras',
        'estado_pago',
        'cant_pagada'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'idproducto');
    }
}
