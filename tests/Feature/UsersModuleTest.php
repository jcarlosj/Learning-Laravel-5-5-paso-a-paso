<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersModuleTest extends TestCase
{
    /**
     * Prueba: carga la página de lista de usuarios
     * @test
     */
    function it_loads_the_users_list_page()
    {
        $this -> get( '/usuarios' )          # Simula petición a la URL /usuarios
              -> assertStatus( 200 )         # Comprueba el estado de la petición
              -> assertSee( 'Usuarios' );    # Comprueba que el código fuente de la página generada se puede ser ese texto
    }
    /** @test */
    function it_loads_the_users_details_page()
    {
        $this -> get( '/usuario/5' )        # Simula petición a la URL /usuario/5
        -> assertStatus( 200 )              # Comprueba el estado de la petición
        -> assertSee( 'id: 5' );            # Comprueba que el código fuente de la página generada se puede ser ese texto
    }
}
