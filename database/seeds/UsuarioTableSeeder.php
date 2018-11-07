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
                'run' => '19313621-4',
                'nombre' => 'Patrick',
                'appat' => 'Ciudad',
                'apmat' => 'Iturra',
                'direccion' => 'La Casa 1931',
                'telefono' => '+56993557050',
                'email' => 'PatrickWCity@gmail.com'
            ],
            [
                'run' => '18053187-4',
                'nombre' => 'Alvaro',
                'appat' => 'Rodriguez',
                'apmat' => 'Acevedo',
                'direccion' => 'La Casa 1805',
                'telefono' => '+56948112410',
                'email' => 'ARodriguezA89@gmail.com'
            ],
            [
                'run' => '18377247-3',
                'nombre' => 'Vicente',
                'appat' => 'Vidal',
                'apmat' => 'Alvarado',
                'direccion' => 'La Casa 1837',
                'telefono' => '+56968605054',
                'email' => 'HellBlazer25@gmail.com'
            ]
        ]);
    }
}
