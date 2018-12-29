<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        # Datos estáticos
        $users = [ 'Elisa', 'Ana', 'Melisa', 'Luisa', '<script>alert( "Juliana" )</script>' ];    # Array
        $title = 'Usuarios';

        dd( compact( 'title', 'users' ) );                    # Helper de Laravel similar a ejecutar var_dump(); die(); en PHP

        return view( 'users', compact( 'title', 'users' ) );  # Pasa datos a la vista que son variables locales usando sus nombres para convertirlas en un array asociativo
    }

    public function show( $id )
    {
        return 'id: ' .$id;
    }

    public function create()
    {
        return 'Crea usuario nuevo';
    }
}
