<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        # Obtenemos los usuarios registrados (En este caso usando ORM Eloquent de Laravel)
        $users = User :: all();
        #dd( 'usuarios registrados ', $users );

        $title = 'Usuarios';
        #dd( compact( 'title', 'users' ) );                    # Helper de Laravel similar a ejecutar var_dump(); die(); en PHP

        // return view( 'users.index' )
        //           -> with( 'users', User::all() )
        //           -> with( 'title', 'Usuarios' );

        # (Sin espacios) pues users hace referencia al directorio y el archivo así: /users/index.blade.php
        return view( 'users.index', compact( 'title', 'users' ) );  # Pasa datos a la vista que son variables locales usando sus nombres para convertirlas en un array asociativo
    }

    public function show( User $user )
    {
        #dd( $user );
        # (Sin espacios) pues users hace referencia al directorio y el archivo así: /users/show.blade.php
        return view( 'users.show', compact( 'user' ) );
    }

    public function create()
    {
        return view( 'users.create' );        # Muestra formulario creación de usuarios /users/create.blade.php
    }

    public function store()
    {
        $data = request() -> all();           # Obtenemos los datos enviados a través del formulario
        #dd( $data );

        # Valida que el campo 'name' esta vacío
        if( empty( $data[ 'name' ] ) ) {
            return redirect( 'usuarios/nuevo' ) -> withErrors([     # Finaliza la ejecución y redirecciona al formulario con la URL fija /usuarios/nuevo
                'name' => 'El nombre es obligatorio!'               # Agrega el campo al listado de errores esperados a la sesión usando el método proporcionado por Laravel withErrors() para esta tarea
            ]);
        }

        User :: create([
            'name' => $data[ 'name' ],
            'email' => $data[ 'email' ],
            'password' => bcrypt( $data[ 'password' ] )
        ]);

        return redirect( route( 'users.index' ) );
    }
}
