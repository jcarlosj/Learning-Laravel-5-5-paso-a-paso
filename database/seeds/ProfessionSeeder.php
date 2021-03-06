<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;
use App\Models\Profession;

class ProfessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Realiza inserciones usando sentencias SQL a través del método insert() */
        DB :: insert( 'INSERT INTO tb_profesiones ( title ) VALUES ( "FullStack JavaScript Developer" ) ' );      # SIN marcadores de posición (cuando los datos NO VIENEN directamente de los usuarios), la cadena se pasa con comillas dobles

        DB :: insert( 'INSERT INTO tb_profesiones ( title ) VALUES ( ? ) ', [ 'Android Mobile Developer' ] );     # CON marcadores de posición (cuando los datos VIENEN directamente de los usuarios, es decir el usuario envia el dato y este esta alojado en una variable), la cadena se pasa como un Array
        # NOTA: Debemos usar un marcador ? para indicar la posición de un parámetro dinámico, que nos protegerá de inyección SQL en el valor pasado

        DB :: insert( 'INSERT INTO tb_profesiones ( title ) VALUES ( :title )', [                                 # CON parámetros de sustitución (cuando los datos VIENEN directamente de los usuarios ), la cadena se pasa como un Array asociativo
            'title' => 'iOS Mobile Developer'
        ]);
        # NOTA: Cuando hay muchos parámetros lo mejor es usar un parámetro de sustitución con nombre, que también nos protegerá de la inyección SQL

        /* Realiza inserciones a nuestra tabla 'tb_profesiones' */
        DB :: table( 'tb_profesiones' ) -> insert([
            'title' => 'BackEnd Developer'
        ]);
        DB :: table( 'tb_profesiones' ) -> insert([
            'title' => 'FrontEnd Developer'
        ]);
        DB :: table( 'tb_profesiones' ) -> insert([
            'title' => 'Web Designer'
        ]);

        /* Realiza inserciones usando el ORM Eloquent de Laravel */
        Profession :: create([
            'title' => 'Software Architect'
        ]);
        Profession :: create([
            'title' => 'Project Manager'
        ]);

        /* Realiza 10, inserciones usando usando Model Factories usando el Helper factory() de Laravel */
        factory( Profession :: class, 10 ) -> create();
    }
}
