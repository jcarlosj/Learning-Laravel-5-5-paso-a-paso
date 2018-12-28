<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersModuleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this -> get( '/usuarios' )          # Simula petición a la URL /usuarios
              -> assertStatus( 200 )         # Comprueba el estado de la petición
              -> assertSee( 'Usuarios' );    # Comprueba que el código fuente de la página generada se puede ser ese texto
    }
}
