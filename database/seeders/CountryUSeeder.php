<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CountryUSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries  =
        [
            [
                'prefijo'           => 'AR',
                'descripcion'       => 'ARGENTINA',
                'codigo_telefono'   => '+54',
                'signo'             => '$',
                'moneda'            => 'PESOS',
                'estado'            => 1
            ],
            [
                'prefijo'           => 'CH',
                'descripcion'       => 'CHILE',
                'codigo_telefono'   => '+56',
                'signo'             => '$',
                'moneda'            => 'PESOS',
                'estado'            => 1
            ],
            [
                'prefijo'           => 'COL',
                'descripcion'       => 'COLOMBIA',
                'codigo_telefono'   => '+57',
                'signo'             => '$',
                'moneda'            => 'PESOS',
                'estado'            => 1
            ],
            [
                'prefijo'           => 'CRC',
                'descripcion'       => 'Costa Rica',
                'codigo_telefono'   => '+506',
                'signo'             => '₡',
                'moneda'            => 'COLONES',
                'estado'            => 1
            ],
            [
                'prefijo'           => 'VEN',
                'descripcion'       => 'VENEZUELA',
                'codigo_telefono'   => '+58',
                'signo'             => 'BS',
                'moneda'            => 'BOLIVARES',
                'estado'            => 1
            ],
            [
                'prefijo'           => 'BOL',
                'descripcion'       => 'BOLIVIA',
                'codigo_telefono'   => '+591',
                'signo'             => '$b',
                'moneda'            => 'PESOS',
                'estado'            => 1
            ],
            [
                'prefijo'           => 'MEX',
                'descripcion'       => 'MEXICO',
                'codigo_telefono'   => '+52',
                'signo'             => '$',
                'moneda'            => 'MX',
                'estado'            => 1
            ],
            [
                'prefijo'           => 'PAR',
                'descripcion'       => 'PARAGUAY',
                'codigo_telefono'   => '+595',
                'signo'             => '₲',
                'moneda'            => 'GUARANIES',
                'estado'            => 1
            ],
            [
                'prefijo'           => 'RD',
                'descripcion'       => 'REPUBLICA DOMINICANA',
                'codigo_telefono'   => '+1-809',
                'signo'             => 'RD$',
                'moneda'            => 'PESOS',
                'estado'            => 1
            ],
            [
                'prefijo'           => 'CU',
                'descripcion'       => 'CUBA',
                'codigo_telefono'   => '+53',
                'signo'             => '$',
                'moneda'            => 'PESOS',
                'estado'            => 1
            ],
            [
                'prefijo'           => 'GT',
                'descripcion'       => 'GUATEMALA',
                'codigo_telefono'   => '+502',
                'signo'             => 'Q',
                'moneda'            => 'QUETZALES',
                'estado'            => 1
            ],
        ];

        foreach($countries as $country)
        {
            $new_country = new \App\Models\CountryU();
            foreach($country as $key => $value)
            {
                $new_country->{$key}  = $value;
            }

            $new_country->save();
        }
    }
}
