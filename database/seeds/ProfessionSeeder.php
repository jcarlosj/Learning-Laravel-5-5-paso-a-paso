<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class ProfessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB :: statement( 'SET FOREIGN_KEY_CHECKS = 0;' );  /* Sentencia SQL para DESHABILITAR revisión de llaves foráneas */
        DB :: table( 'professions' ) -> truncate();        /* Trunca o vacia la tabla 'professions' antes de hacer inserciones */
        DB :: statement( 'SET FOREIGN_KEY_CHECKS = 1;' );  /* Sentencia SQL para HABILITAR revisión de llaves foráneas */
        # NOTA: Es importante tener en cuenta no tener restricciones de llave foránea,
        #       si no no se podrá truncar la tabla.
        # SOLUCION:
        #  - Comentar la línea de creación de la llave forárea, ejecutar una migración
        #    para realizar cambios y luego ejecutar el seeder, reestableciendo la llave
        #    foránea al finalizar el proceso
        #  - Deshabilitar la revisión de llaves foráneas de nuestro motor de bases de datos

        /* Realiza inserciones a nuestra tabla 'professions' */
        DB :: table( 'professions' ) -> insert([
            'title' => 'BackEnd Developer'
        ]);
        DB :: table( 'professions' ) -> insert([
            'title' => 'FrontEnd Developer'
        ]);
        DB :: table( 'professions' ) -> insert([
            'title' => 'Web Designer'
        ]);
    }
}
