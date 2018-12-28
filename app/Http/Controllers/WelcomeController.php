<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index() {}

    public function welcomeIDNickname( $idu, $apodo ) {
        return "Bienvenido {$apodo}, tú id es: {$idu}";
    }
}
