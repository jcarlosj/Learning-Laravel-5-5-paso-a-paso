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
/* PATH: / */
Route::get('/', function () {
    return 'Home';
});

/* PATH: /usuarios */
Route :: get( '/usuarios/{user}', 'UserController@show' )      // Pasando parámetros dinámicos a una ruta, filtro de ruta entero
      -> where( 'user', '[0-9]+' )
      -> name( 'users.show' );                                 // Nombre de la ruta

Route :: get( '/usuarios', 'UserController@index' )            # <--- RUTAS IGUALES con DIFERENTE MÉTODO HTTP
      -> name( 'users.index' );                                // Nombre de la ruta

Route :: get( '/usuarios/nuevo', 'UserController@create' )
      -> name( 'users.create' );                               // Nombre de la ruta
Route :: get( '/usuarios/{user}/editar', 'UserController@edit' )
      -> name( 'users.edit' );
Route :: post( '/usuarios', 'UserController@store' )           # <--- RUTAS IGUALES con DIFERENTE MÉTODO HTTP
      -> name( 'users.store' );

# NOTA: Importante definir un estándar de nombres de ruta para todo el proyecto

/* PATH: /contacto */
Route :: get( '/contacto', 'WelcomeController@contacto' )
      -> name( 'site.contact' );                               // Nombre de la ruta

/*
// Ruta con múltiples peticiones
Route :: get( 'usuario/{slug}', function ( $slug ) {
    return "Acción: $slug";
}) -> where( [ 'slug' => 'create|delete|update' ] );

// La misma ruta anterior /usuario/<parametro>, filtro de ruta una cadena
Route :: get( '/usuario/{nombre}', 'WelcomeController@thenName' )
      -> where( 'nombre', '[-\w]+' );


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
*/
