<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WelcomeUsersTest extends TestCase
{
    /** @test */
    public function it_welcome_users_with_nickname()
    {
        $this -> get( '/usuarios/juan/jcarlosj' )                            # Simula petición a la URL /usuarios/juan/jcarlosj
              -> assertStatus( 200 )                                         # Comprueba el estado de la petición
              -> assertSee( 'Bienvenido Juan, tú usuario es: jcarlosj' );    # Comprueba que el código fuente de la página generada se puede ser ese texto
    }
    /** @test */
    public function it_welcome_users_without_nickname()
    {
        $this -> get( '/usuarios/juan' )            # Simula petición a la URL /usuarios/juan
              -> assertStatus( 200 )                # Comprueba el estado de la petición
              -> assertSee( 'Bienvenido Juan' );    # Comprueba que el código fuente de la página generada se puede ser ese texto
    }
}
