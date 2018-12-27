<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(PerfilTableSeeder::class);
         $this->call(UsuarioTableSeeder::class);
         $this->call(AccesoTableSeeder::class);
         $this->call(PerfilUsuarioTableSeeder::class);
         $this->call(TipoVoluntarioTableSeeder::class);
         // $this->call(ModuloTableSeeder::class);
        // $this->call(ModuloPerfilTableSeeder::class);
        // $this->call(SubmoduloTableSeeder::class);
        // $this->call(SubmoduloModuloTableSeeder::class);
    }
}
