<?php

use Illuminate\Database\Seeder;

class ProfessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB :: table( 'professions' ) -> insert([
            'title' => 'BackEnd Developer'
        ]);
        \Illuminate\Support\Facades\DB :: table( 'professions' ) -> insert([
            'title' => 'BackEnd Developer'
        ]);
        \Illuminate\Support\Facades\DB :: table( 'professions' ) -> insert([
            'title' => 'Web Designer'
        ]);
    }
}
