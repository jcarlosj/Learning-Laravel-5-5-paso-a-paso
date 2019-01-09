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
        /* Ejemplos de consultas SQL usando el método select() del Facade DB de Lavavel */
        $professions_1 = DB :: select( 'SELECT id FROM professions WHERE title = ?', [ 'BackEnd Developer' ] );                # Obtiene el ID del campo donde title es "BackEnd Developer"
        $professions_2 = DB :: select( 'SELECT id FROM professions WHERE title = ? LIMIT 0,1', [ 'BackEnd Developer' ] );      # Obtiene un ID o ninguno si el campo title es "BackEnd Developer"
        $professions_3 = DB :: select( 'SELECT id FROM professions LIMIT 0,1' );                                               # Obtiene el primer ID registrado en la tabla, siempre que existan registros en ella
        dd(
            'Consulta 1: SELECT id FROM professions WHERE title = ?', $professions_1,
            'Consulta 2: SELECT id FROM professions WHERE title = ? LIMIT 0,1', $professions_2,
            'Consulta 3: SELECT id FROM professions LIMIT 0,1', $professions_3
        );

        /* Realiza inserciones a nuestra tabla 'users' */
        DB :: table( 'users' ) -> insert([
            'name' => 'Juan Carlos Jiménez Gutiérrez',
            'email' => 'jcjimenez29@misena.edu.co',
            'password' => bcrypt( 'laravel' ),            # bcrypt(): Helper de Laravel para encriptar contraseñas
            'profession_id' => $professions[ 0 ] -> id    # Insertamos un ID existente en la tabla 'professions'
        ]);
    }
}
