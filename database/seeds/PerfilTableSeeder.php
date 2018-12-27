<?php

use Illuminate\Database\Seeder;

class PerfilTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Perfil')->insert([
            [
                'nombre' => 'Administrador',
                'descripcion' => 'El Administrador Administra el Sistema.',
            ],
            [
                'nombre' => 'Usuario',
                'descripcion' => 'El Usuario tiene acceso basico en el Sistema.',
            ],
            [
                'nombre' => 'Ogranizador de Eventos',
                'descripcion' => 'El Encargado de Comunicaciones es el que Organiza los Eventos dentro del Sistema.',
            ],
            [
                'nombre' => 'Autor',
                'descripcion' => 'El Autor crea las Noticias en el Sistema.',
            ],
            [
                'nombre' => 'Gestor de Documentos',
                'descripcion' => 'El Gestor de Documentos es el que Gestiona los Documentos dentro del Sistema.',
            ],
            [
                'nombre' => 'Desarrollador',
                'descripcion' => 'El Desarrollador Desarrolla el Sistema.',
            ]
        ]);
    }
}
