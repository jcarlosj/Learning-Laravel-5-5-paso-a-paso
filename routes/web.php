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

// Pasando parámetros dinámicos a una ruta
Route :: get( '/usuarios/{id}', function( $id ) {
    return 'id: ' .$id;
});
Route :: get( '/usuarios/nuevo', function() {
    return 'Crea usuario nuevo';
});
