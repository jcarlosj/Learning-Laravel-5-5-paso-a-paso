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
        $data = request() -> validate([     # Método para validar automáticamente un campo específico de un conjunto de campos extraidos de una consulta (redirigiendo automáticamente a la URL anterior)
            'name' => 'required',            # Registro al listado de errores de sesión de campo esperado y una cadena con las reglas de validación que se quieren aplicar
            'email' => [ 'required', 'email', 'unique:users,email' ],     # (unique:users,email) equivale a: (regla:tabla,columna)
            'password' => 'required|alpha_num|min:7'
        ], [
            'name.required' => 'El nombre es obligatorio!',  # Reescribe los mensaje por defecto (en Inglés) retornados por el método validate que se encuentran en /resources/lang/en/validate.php
            'email.required' => 'El correo electrónico es obligatorio!',
            'email.email' => 'No es un correo electrónico válido!',
            'email.unique' => 'Este correo electrónico ya está registrado!',
            'password.required' => 'La contraseña es obligatoria!',
            'password.min' => 'La contraseña debe tener mínimo 7 caracteres!',
            'password.alpha_num'  => 'La contraseña debe ser alfanumérica!',
        ]); # Obtenemos los datos enviados a través del formulario
        #dd( $data );

        User :: create([
            'name' => $data[ 'name' ],
            'email' => $data[ 'email' ],
            'password' => bcrypt( $data[ 'password' ] )
        ]);

        return redirect( route( 'users.index' ) );
    }

    public function edit( User $user )
    {
        return view( 'users.edit', [ 'user' => $user ] );    # Retorna la vista a la que se le pasa la variable 'user' como parámetro
    }

    public function update( User $user )
    {
        $data = request() -> validate([
            'name' => 'required',
            'email' => '',
            'password' => ''
        ], [
            'name.required'  => 'El nombre es obligatorio!'
        ]);        # Obtendo todos los datos del formulario
        
        $data[ 'password' ] = bcrypt( $data[ 'password' ] );    # Encripto la contraseña
        $user -> update( $data );          # Actualiza registro enviando un Array Asociativo con los datos a actualizar

        #return redirect( "usuarios/{$user -> id}" );
        return redirect() -> route( 'users.show', [ 'user' => $user ] );
    }
}
