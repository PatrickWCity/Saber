<?php

use Illuminate\Database\Seeder;

class UsuarioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Usuario')->insert([
            [
                'run' => '',
                'nombre' => 'Construyendo Mis',
                'appat' => 'Sueños',
                'apmat' => '',
                'direccion' => 'Domeyko 2361, Santiago, Chile',
                'telefono' => '+56 2 2978 4060',
                'email' => 'comunicaciones@construyendomissuenos.cl'
            ]
        ]);
    }
}
