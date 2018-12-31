<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index() {}

    public function welcomeIDNickname( $idu, $apodo ) {
        return "Bienvenido {$apodo}, tú id es: {$idu}";
    }
    public function welcomeNameNickname( $nombres, $apodo ) {
        return "Hola {$nombres}!, tú apodo es: {$apodo}";
    }
    public function thenName( $nombre ) {
        return "Entonces te llamas {$nombre}";
    }
    public function contacto() {
        return view( 'contacto' );
    }
}
