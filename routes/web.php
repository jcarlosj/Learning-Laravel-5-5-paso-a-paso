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
Route :: get( '/usuario/{id}', function( $id ) {
    return 'id: ' .$id;
}) -> where( 'id', '[0-9]+' );

// Ruta con múltiples peticiones
Route :: get( 'usuario/{slug}', function ( $slug ) {
    return "Acción: $slug";
}) -> where( [ 'slug' => 'create|delete|update' ] );

// La misma ruta anterior /usuario/<parametro>, filtro de ruta una cadena
Route :: get( '/usuario/{nombre}', function( $nombre ) {
    return "Entonces te llamas {$nombre}";
}) -> where( 'nombre', '[-\w]+' );

Route :: get( '/usuarios', function() {
    return 'Usuarios';
});

Route :: get( '/usuarios/nuevo', function() {
    return 'Crea usuario nuevo';
});

// Pasando parámetros dinámicos opcionales a una ruta
Route :: get( '/usuarios/{name}/{nickname?}', function( $name, $nickname = null ) {
    if( $nickname ) {
        return "Bienvenido {$name}, tú usuario es: {$nickname} ";
    }
    else {
        return "Bienvenido {$name}";
    }
});

// Filtros de ruta para 1 o más parámetros
Route :: get( '/usuario/{idu}/{apodo}', function( $idu, $apodo ) {
    return "Bienvenido {$apodo}, tú id es: {$idu}";
}) -> where([
    'idu' => '[\d]+',
    'apodo' => '[-\w]+'
]);
Route :: get( '/usuario/{nombres}/{apodo}', function( $nombres, $apodo ) {
    return "Hola {$nombres}!, tú apodo es: {$apodo}";
}) -> where([
    'nombres' => '[-\w]+',
    'apodo' => '[-\w]+'
]);;
