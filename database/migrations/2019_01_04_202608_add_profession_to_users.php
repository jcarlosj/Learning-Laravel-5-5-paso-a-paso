<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProfessionToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        # Agrega el campo 'profession' a la tabla 'users'
        Schema :: table ( 'users', function( Blueprint $table ) {
            $table -> string( 'profession', 50 ) -> nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        # Elimina el campo 'profession' a la tabla 'users'
        Schema :: table ( 'users', function( Blueprint $table ) {
            $table -> dropColumn( 'profession' );
        });
    }
}
