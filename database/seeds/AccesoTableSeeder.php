<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class AccesoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Acceso')->insert([
            [
                'username' => 'administrador',
                'password' => Hash::make('CMS2018**'),
                'diasClave' => '14',
                'fechaCaducidad' => Carbon::now()->addDays(14),
                'email' => 'comunicaciones@construyendomissuenos.cl',
                'estadoInicial' => '1',
                'email_verified_at' => Carbon::now(),
                'foto' => 'default.png',
                'idUsuario' => '1',
            ]
        ]);
    }
}
