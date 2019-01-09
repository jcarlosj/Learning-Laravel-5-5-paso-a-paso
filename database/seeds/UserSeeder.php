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
        /* Ejemplo de consultas SQL usando el método select() del Facade DB de Lavavel */
        #$profession = DB :: select( 'SELECT id FROM professions WHERE title = ?', [ 'BackEnd Developer' ] );                # Obtiene el ID del campo donde title es "BackEnd Developer"

        /* Ejemplos usando el Constructor de consultas de Laravel usando el método where() */
        $profession_id = DB :: table( 'professions' )               # Obtiene un objeto con un solo Array obteniendo de este sus valores
                         -> where(
                             [ 'title' => 'BackEnd Developer' ]     # Argumentos: Usando un Array Asosiativo
                         ) -> value( 'id' );                        # Con este método indicamos el campo del que deseamos obtener el valor

        dd( $profession_id );

        /* Realiza inserciones a nuestra tabla 'users' */
        DB :: table( 'users' ) -> insert([
            'name' => 'Juan Carlos Jiménez Gutiérrez',
            'email' => 'jcjimenez29@misena.edu.co',
            'password' => bcrypt( 'laravel' ),            # bcrypt(): Helper de Laravel para encriptar contraseñas
            'profession_id' => $profession_id             # Insertamos un ID existente en la tabla 'professions'
        ]);
    }
}
