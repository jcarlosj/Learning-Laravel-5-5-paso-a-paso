<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        # Datos estáticos
        $users = [ 'Elisa', 'Ana', 'Melisa', 'Luisa', '<script>alert( "Juliana" )</script>' ];    # Array

        return view( 'users' ) -> with([    # Encadena el método with() al Helper view() para pasar los datos a la vista usando la estructura de un Array Asociativo
           'title' => 'Usuarios',
           'users' => $users
        ]);
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
