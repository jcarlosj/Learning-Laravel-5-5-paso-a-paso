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
        /* Obtener el id del campo con title "BackEnd Developer" usando el método select() */
        $professions = DB :: select( 'SELECT id FROM professions WHERE title = "BackEnd Developer"' );
        #dd( $professions );

        /* Realiza inserciones a nuestra tabla 'users' */
        DB :: table( 'users' ) -> insert([
            'name' => 'Juan Carlos Jiménez Gutiérrez',
            'email' => 'jcjimenez29@misena.edu.co',
            'password' => bcrypt( 'laravel' ),            # bcrypt(): Helper de Laravel para encriptar contraseñas
            'profession_id' => $professions[ 0 ] -> id    # Insertamos un ID existente en la tabla 'professions'
        ]);
    }
}
