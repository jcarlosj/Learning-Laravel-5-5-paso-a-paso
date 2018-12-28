<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeUserController extends Controller
{
    # El método __invoke() es llamado cuando un script intenta llamar a un objeto como si fuera una función.
    # Esta es la forma de obligar a una clase a tener exclusivamente una sola acción o método público.
    public function __invoke( $name, $nickname = null ) {
        $name = ucfirst( $name );

        if( $nickname ) {
            return "Bienvenido {$name}, tú usuario es: {$nickname} ";
        }
        else {
            return "Bienvenido {$name}";
        }
    }
}
