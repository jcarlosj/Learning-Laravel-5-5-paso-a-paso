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
        #$data = request() -> all();           # Obtenemos los datos enviados a través del formulario
        #dd( $data );

        User :: create([                                           # Alternativas para obtener datos de un campo proveniente del objeto Request
            'name' => request( 'name' ),                           # Forma 1: Pasando como parámetro al método request(), el nombre del campo del formulario (o propiedad del objeto Request)
            'email' => request() -> email,                         # Forma 2: Accesando directamente a la propiedad del objeto Request que hace referencia al campo del formulario
            'password' => bcrypt( request() -> get( 'password' ) ) # Forma 3: Encadenando al objeto request() el método get() al que se le pasa como argumento el nombre del campo del formulario (o propiedad del objeto Request)
        ]);

        return redirect( route( 'users.index' ) );
    }
}
