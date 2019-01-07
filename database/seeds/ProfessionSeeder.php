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
