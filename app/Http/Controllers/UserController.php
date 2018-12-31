<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        # Valida si el campo 'empty' a sido pasado por la URL y Simula la existencia de datos
        if( request() -> has( 'empty' ) ) {
            # Si URL es: http://127.0.0.1:8000/usuarios?empty
            $users = [];
        }
        else {
            # Si URL es: http://127.0.0.1:8000/usuarios
            $users = [ 'Elisa', 'Ana', 'Melisa', 'Luisa', '<script>alert( "Juliana" )</script>' ];    # Array Datos estáticos
        }

        $title = 'Usuarios';

        #dd( compact( 'title', 'users' ) );                    # Helper de Laravel similar a ejecutar var_dump(); die(); en PHP

        return view( 'users', compact( 'title', 'users' ) );  # Pasa datos a la vista que son variables locales usando sus nombres para convertirlas en un array asociativo
    }

    public function show( $id )
    {
        return view( 'users-show', compact( 'id' ) );
    }

    public function create()
    {
        return 'Crea usuario nuevo';
    }
}
