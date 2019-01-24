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
    function it_displays_the_users_details()
    {
        $user = factory( User :: class ) -> create([
            'name' => 'Luisa Bazalar',
            'email' => 'lubazalar@correo.co'
        ]);
        $this -> withoutExceptionHandling();

        $this -> get( '/usuarios/' .$user -> id )        # Simula petición a la URL /usuario/5
        -> assertStatus( 200 )              # Comprueba el estado de la petición
        -> assertSee( 'Luisa Bazalar' )
        -> assertSee( 'lubazalar@correo.co' )
        -> assertSee( '#' .$user -> id );   # Comprueba que el código fuente de la página generada se puede ser ese texto
    }
    /** @test */
    function it_displays_a_404_error_if_the_user_is_not_found() {
        $this -> get( '/usuarios/1000' )
              -> assertStatus( 404 )
              -> assertSee( 'Página no encontrada!' );
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
