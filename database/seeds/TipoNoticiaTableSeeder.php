<?php

use Illuminate\Database\Seeder;

class TipoNoticiaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('TipoNoticia')->insert([
            [
                'nombre' => 'Prensa',
                'descripcion' => 'Noticia de Prensa.',
            ]
        ]);
    }
}
