<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use App\User;

class UsersModuleTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Prueba: Muestra la lista de usuarios
     * @test
     */
    function it_shows_the_users_list()
    {
        /* Registro los usuarios esperados usando Model Factories */
        factory( User :: class ) -> create([
            'name' => 'Elisa',
            'website' => 'www.matiz.co'
        ]);
        factory( User :: class ) -> create([
            'name' => 'Juliana',
            'website' => 'www.juliana.me'
        ]);

        $this -> get( '/usuarios' )          # Simula petición a la URL /usuarios
              -> assertStatus( 200 )         # Comprueba el estado de la petición
              -> assertSee( 'Usuarios' )     # Comprueba que el código fuente de la página generada se puede ser ese texto
              -> assertSee( 'Elisa' )
              -> assertSee( 'Juliana' );
    }
    /**
     * Prueba: Muestra mensaje por defecto si la lista de usuarios está vacía
     * @test
     */
    function it_shows_a_default_message_if_the_users_list_is_empty()
    {
        $this -> get( '/usuarios' )                        # Simula petición a la URL /usuarios
              -> assertStatus( 200 )                             # Comprueba el estado de la petición
              -> assertSee( 'No hay usuarios registrados' );     # Comprueba que el código fuente de la página generada se puede ser ese texto
    }
    /** @test */
    function it_loads_the_users_details_page()
    {
        $this -> withoutExceptionHandling();

        $this -> get( '/usuario/5' )        # Simula petición a la URL /usuario/5
        -> assertStatus( 200 )              # Comprueba el estado de la petición
        -> assertSee( 'id: 5' );            # Comprueba que el código fuente de la página generada se puede ser ese texto
    }
    /** @test */
    function it_loads_the_new_user_page()
    {
        $this -> withoutExceptionHandling();    # Permitirá que los ERRORES se puedan visualizar en la terminal

        $this -> get( '/usuarios/nuevo' )        # Simula petición a la URL /usuario/5
        -> assertStatus( 200 )                  # Comprueba el estado de la petición
        -> assertSee( 'Crea usuario nuevo' );   # Comprueba que el código fuente de la página generada se puede ser ese texto
    }
}
