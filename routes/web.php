<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return 'Home';
});

Route :: get( '/contacto', function() {
    return 'Contacto';
});

// Pasando parámetros dinámicos a una ruta, filtro de ruta entero
Route :: get( '/usuario/{id}', 'UserController@show' )
      -> where( 'id', '[0-9]+' );

// Ruta con múltiples peticiones
Route :: get( 'usuario/{slug}', function ( $slug ) {
    return "Acción: $slug";
}) -> where( [ 'slug' => 'create|delete|update' ] );

// La misma ruta anterior /usuario/<parametro>, filtro de ruta una cadena
Route :: get( '/usuario/{nombre}', function( $nombre ) {
    return "Entonces te llamas {$nombre}";
}) -> where( 'nombre', '[-\w]+' );

Route :: get( '/usuarios', 'UserController@index' );

Route :: get( '/usuarios/nuevo', 'UserController@create' );

// Pasando parámetros dinámicos opcionales a una ruta
Route :: get( '/usuarios/{name}/{nickname?}', 'WelcomeUserController' );# Solo llamamos al controlador sin indicarle el nombre del método

// Filtros de ruta para 1 o más parámetros
Route :: get( '/usuario/{idu}/{apodo}', 'WelcomeController@welcomeIDNickname' )
      -> where([
          'idu' => '[\d]+',
          'apodo' => '[-\w]+'
      ]);
Route :: get( '/usuario/{nombres}/{apodo}', 'WelcomeController@welcomeNameNickname' )
      -> where([
         'nombres' => '[-\w]+',
         'apodo' => '[-\w]+'
      ]);;
