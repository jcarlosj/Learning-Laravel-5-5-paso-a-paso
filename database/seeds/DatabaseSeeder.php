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
        /* Ejecuta Vaciado o Truncado de tablas */
        $this -> truncateAllTables();
        // $this->call(UsersTableSeeder::class);
        #dd( ProfessionSeeder :: class );               /* Retorna el nombre del Seeder, en este caso: 'ProfessionSeeder' */

        /* Registro de Seeders */
        $this -> call( ProfessionSeeder :: class );
    }

    private function truncateAllTables() {
        DB :: statement( 'SET FOREIGN_KEY_CHECKS = 0;' );  /* Sentencia SQL para DESHABILITAR revisión de llaves foráneas */
        DB :: table( 'users' ) -> truncate();              /* Trunca o vacia la tabla 'professions' antes de hacer inserciones */
        DB :: table( 'professions' ) -> truncate();        /* Trunca o vacia la tabla 'professions' antes de hacer inserciones */
        DB :: statement( 'SET FOREIGN_KEY_CHECKS = 1;' );  /* Sentencia SQL para HABILITAR revisión de llaves foráneas */
    }
}
