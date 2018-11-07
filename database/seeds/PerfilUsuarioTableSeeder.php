<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PerfilUsuarioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('PerfilUsuario')->insert([
            [
                'fecha' => Carbon::now(),
                'estado' => '1',
                'idPerfil' => '1',
                'idUsuario' => '1',
            ],
            [
                'fecha' => Carbon::now(),
                'estado' => '1',
                'idPerfil' => '1',
                'idUsuario' => '2',
            ],
            [
                'fecha' => Carbon::now(),
                'estado' => '1',
                'idPerfil' => '1',
                'idUsuario' => '3',
            ]
        ]);
    }
}
