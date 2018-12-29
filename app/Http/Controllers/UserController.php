<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        # Datos estáticos
        $users = [ 'Elisa', 'Ana', 'Melisa', 'Luisa', '<script>alert( "Juliana" )</script>' ];    # Array

        return view( 'users' )
               -> with( 'title', 'Usuarios' )    # Encadena varias veces el método with() al Helper view() para
               -> with( 'users', $users );       # pasar los datos a la vista de forma individual
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
