<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountryU extends Model
{
    use HasFactory;
    protected $table        = 'country_u_s';
    protected $primaryKey   = 'id';

    protected $fillable     =
    [
        'prefijo',
        'descripcion',
        'codigo_telefono',
        'signo',
        'moneda',
        'estado'
    ];
}
