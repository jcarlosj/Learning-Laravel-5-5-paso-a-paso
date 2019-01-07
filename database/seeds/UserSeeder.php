<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;    # Importa Facade DB usando su namespace

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Realiza inserciones a nuestra tabla 'users' */
        DB :: table( 'users' ) -> insert([
            'name' => 'Juan Carlos Jiménez Gutiérrez',
            'email' => 'jcjimenez29@misena.edu.co',
            'password' => bcrypt( 'laravel' )            # bcrypt(): Helper de Laravel para encriptar contraseñas
        ]);
    }
}
