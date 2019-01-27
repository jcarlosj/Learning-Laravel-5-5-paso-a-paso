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
    /** @test */
    function it_creates_a_new_user() {
        $this -> withoutExceptionHandling();    # Permitirá que los ERRORES se puedan visualizar en la terminal

        # Simula el envio de los datos por el método POST a través del formulario
        $this -> post( '/usuarios', [                        # Simula petición POST a la URL /usuarios
            'name' => 'Juan Carlos Jiménez Gutiérrez',       # Datos enviados
            'email' => 'jcjimenez29@misena.edu.co',
            'password' => 'laravel'
        ]) -> assertRedirect( route( 'users.index' ) );                  # Verifica que haya una redirección al listado de usuarios usando el Helper Rout para hacerlo

        # Valida datos contra la base de datos
        $this -> assertCredentials([                        # El método assertCredentials() no requiere el nombre de la tabla siempre que usemos la tabla por defecto de la instalación de Laravel
            'name' => 'Juan Carlos Jiménez Gutiérrez',      # Campos/Columnas y los valores que esperamos encontrar
            'email' => 'jcjimenez29@misena.edu.co',
            'password' => 'laravel'                         # El método assertCredentials() perminte validad la contraseña de un usuario cosa que el método assertDatabaseHas() no permite. Además sin usar el método de encriptación.
        ]);
    }
    /** @test */
    function the_name_is_required() {
        $this -> withoutExceptionHandling();    # Permitirá que los ERRORES se puedan visualizar en la terminal

        # Envia petición de tipo post sin el campo requerido
        $this -> post( '/usuarios', [
            'email' => 'melisasanchezz@correo.co',
            'password' => 'laravel'
        ]) -> assertRedirect( 'usuarios/nuevo' )           # La petición espera una redirección a la URL /usuarios/nuevo (el formulario de registro)
           -> assertSessionHasErrors([                     # Espera la existencia de un campo en el listado de errores de la sesión (en este caso el campo requerido)
               'name'  => 'El nombre es obligatorio!'
            ]);

        # Valida que la base de datos no registro este "nuevo" usuarios
        $this -> assertDatabaseMissing( 'users', [         # Nombre de la tabla donde deseamos validar el registro
            'email' => 'melisasanchezz@correo.co'          # Email: que se espera no encontrar dentro de los registros en la base de datos
        ]);
    }
}
