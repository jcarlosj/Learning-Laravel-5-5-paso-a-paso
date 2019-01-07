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
        /* Ejecuta Vaciado o Truncado de tablas, pasando un Array con sus nombres */
        $this -> truncateAllTables([
            'professions'
        ]);
        // $this->call(UsersTableSeeder::class);
        #dd( ProfessionSeeder :: class );               /* Retorna el nombre del Seeder, en este caso: 'ProfessionSeeder' */

        /* Registro de Seeders */
        $this -> call( ProfessionSeeder :: class );
    }

    private function truncateAllTables( array $tables ) {
        DB :: statement( 'SET FOREIGN_KEY_CHECKS = 0;' );  /* Sentencia SQL para DESHABILITAR revisión de llaves foráneas */
        foreach ( $tables as $key => $table ) {
            DB :: table( $table ) -> truncate();           /* Trunca o vacia la tabla indicada */
        }
        DB :: statement( 'SET FOREIGN_KEY_CHECKS = 1;' );  /* Sentencia SQL para HABILITAR revisión de llaves foráneas */
    }
}
