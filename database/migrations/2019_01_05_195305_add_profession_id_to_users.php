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
        Schema::table('users', function (Blueprint $table) {
            $table -> unsignedInteger( 'profession_id' );    /* Agrega el campo/columna llamada 'professional_id' de tipo entero sin signo */
            $table -> foreign( 'profession_id' ) -> references( 'id' ) -> on( 'professions' ); /* Agrega la llave foránea al campo 'professional_id' de esta tabla, relacionandola con al campo 'id' de la tabla 'professions' */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table -> dropForeign( 'profession_id' );    /* Elimina la llave foránea al campo 'professional_id' */
            $table -> dropColumn( 'profession_id' );     /* Elimina el campo/columna llamada 'professional_id' */
        });
    }
}
