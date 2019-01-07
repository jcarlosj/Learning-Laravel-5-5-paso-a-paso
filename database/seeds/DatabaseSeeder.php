<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        #dd( ProfessionSeeder :: class );               /* Retorna el nombre del Seeder, en este caso: 'ProfessionSeeder' */

        /* Registro de Seeders */
        $this -> call( ProfessionSeeder :: class );
    }
}
