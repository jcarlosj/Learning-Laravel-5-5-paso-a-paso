<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        # Obtenemos los usuarios registrados (En este caso usando el constructor de consultas de Laravel)
        $users = DB :: table( 'users' ) -> get();
        #dd( 'usuarios registrados ', $users );

        $title = 'Usuarios';
        #dd( compact( 'title', 'users' ) );                    # Helper de Laravel similar a ejecutar var_dump(); die(); en PHP

        # (Sin espacios) pues users hace referencia al directorio y el archivo así: /users/index.blade.php
        return view( 'users.index', compact( 'title', 'users' ) );  # Pasa datos a la vista que son variables locales usando sus nombres para convertirlas en un array asociativo
    }

    public function show( $id )
    {
        # (Sin espacios) pues users hace referencia al directorio y el archivo así: /users/show.blade.php
        return view( 'users.show', compact( 'id' ) );
    }

    public function create()
    {
        return 'Crea usuario nuevo';
    }
}
