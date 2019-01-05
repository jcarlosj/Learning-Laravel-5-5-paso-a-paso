<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProfessionIdToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        # Modifica nombre, tipo de campo de la tabla 'users'
        Schema :: table ( 'users', function( Blueprint $table ) {
            $table -> dropColumn( 'profession' );            # Elimina el campo/columna actual llamada 'profession'
            $table -> unsignedInteger( 'profession_id' );    # Agrega el campo/columna llamada 'professional_id' de tipo entero sin signo
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        # Reversa la Modificación de nombre, tipo de campo de la tabla 'users'
        Schema :: table ( 'users', function( Blueprint $table ) {
            $table -> dropColumn( 'profession_id' );            # Elimina el campo/columna actual llamada 'profession_id'
            $table -> string( 'profession', 50 ) -> nullable() -> after( 'password' );    # Agrega el campo 'profession'
        });
    }
}
