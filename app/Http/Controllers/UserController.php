<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view( 'users' );    # Helper 'view' es relativo al directorio /views y luego el nombre del archivo de vista sin extensión
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
