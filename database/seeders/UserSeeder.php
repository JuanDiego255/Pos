<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nombres'   => 'Administrador',
            'user'      => 'admin',
            'password'  => bcrypt('admin123$$.'),
            'estado'    => 1,
            'idcaja'    => 1
        ])->assignRole('SUPERADMIN');

        User::create([
            'nombres'   => 'Admin ventas',
            'user'      => 'ventas',
            'password'  => bcrypt('ventas123$$.'),
            'estado'    => 1,
            'idcaja'    => 1
        ])->assignRole('ADMIN');

        User::create([
            'nombres'   => 'Vendedor',
            'user'      => 'user',
            'password'  => bcrypt('user123.'),
            'estado'    => 1,
            'idcaja'    => 1
        ])->assignRole('VENDEDOR');

        User::create([
            'nombres'   => 'Mesero',
            'user'      => 'mesero',
            'password'  => bcrypt('mesero123.'),
            'estado'    => 1,
            'idcaja'    => 1
        ])->assignRole('MESERO');

        User::create([
            'nombres'   => 'Cocinero',
            'user'      => 'cocina',
            'password'  => bcrypt('cocina123.'),
            'estado'    => 1,
            'idcaja'    => 1
        ])->assignRole('COCINA');
    }
}
