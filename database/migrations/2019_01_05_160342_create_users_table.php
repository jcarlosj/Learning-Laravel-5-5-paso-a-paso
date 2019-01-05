<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table -> unsignedInteger( 'profession_id' );    /* Agrega el campo/columna llamada 'professional_id' de tipo entero sin signo */
            $table -> foreign( 'profession_id' ) -> references( 'id' ) -> on( 'professions' ); /* Agrega la llave foránea al cmapo 'professional_id' de esta tabla, relacionandola con al campo 'id' de la tabla 'professions' */
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
