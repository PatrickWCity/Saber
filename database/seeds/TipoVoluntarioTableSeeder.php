<?php

use Illuminate\Database\Seeder;

class TipoVoluntarioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('TipoVoluntario')->insert([
            [
                'nombre' => 'Hacer mi Práctica',
                'descripcion' => 'Hacer mi Práctica.',
            ],
            [
                'nombre' => 'Hacer mi Memoria',
                'descripcion' => 'Hacer mi Memoria.',
            ],
            [
                'nombre' => 'Hacer una Pasantía',
                'descripcion' => 'Hacer una Pasantía.',
            ],
            [
                'nombre' => 'Unirme al equipo',
                'descripcion' => 'Unirme al equipo.',
            ],
            [
                'nombre' => 'Hacerme Socio(a)',
                'descripcion' => 'Hacerme Socio(a).',
            ],
            [
                'nombre' => 'Quiero ser Voluntario(a)',
                'descripcion' => 'Quiero ser Voluntario(a).',
            ]
        ]);
    }
}
