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
                'username' => 'PatrickWCity',
                'password' => Hash::make('123456'),
                'diasClave' => '14',
                'fechaCaducidad' => Carbon::now()->addDays(14),
                'email' => 'PatrickWCity@gmail.com',
                'estadoInicial' => '1',
                'estadoAcceso' => Carbon::now(),
                'email_verified_at' => Carbon::now(),
                'foto' => 'default.png',
                'idUsuario' => '1',
            ],
            [
                'username' => 'CrossSensei',
                'password' => Hash::make('123456'),
                'diasClave' => '14',
                'fechaCaducidad' => Carbon::now()->addDays(14),
                'email' => 'ARodriguezA89@gmail.com',
                'estadoInicial' => '1',
                'estadoAcceso' => Carbon::now(),
                'email_verified_at' => Carbon::now(),
                'foto' => 'default.png',
                'idUsuario' => '2',
            ],
            [
                'username' => 'Vixo',
                'password' => Hash::make('123456'),
                'diasClave' => '14',
                'fechaCaducidad' => Carbon::now()->addDays(14),
                'email' => 'HellBlazer25@gmail.com',
                'estadoInicial' => '1',
                'estadoAcceso' => Carbon::now(),
                'email_verified_at' => Carbon::now(),
                'foto' => 'default.png',
                'idUsuario' => '3',
            ]
        ]);
    }
}
