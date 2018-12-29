<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        # Datos estáticos
        $users = [ 'Elisa', 'Ana', 'Melisa', 'Luisa', '<script>alert( "Juliana" )</script>' ];    # Array

        return view( 'users' , [    # Helper 'view' es relativo al directorio /views y luego el nombre del archivo de vista sin extensión
            'users' => $users       # Pasando datos para que estén disponibles en la vista
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
