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
    /***  ONLY SHOW LIST  ***/
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
    /***  ONLY CREATE  ***/
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
        #$this -> withoutExceptionHandling();    # Permitirá que los ERRORES se puedan visualizar en la terminal

        # Envia petición de tipo post sin el campo requerido
        $this -> from( 'usuarios/nuevo' )                        # Indica URL de origen de la petición
              -> post( '/usuarios', [                            # Indica tipo de petición y ruta a la que se lanza la petición
                   'email' => 'melisasanchezz@correo.co',
                   'password' => 'laravel'
              ]) -> assertRedirect( 'usuarios/nuevo' )           # La petición espera una redirección a la URL /usuarios/nuevo (el formulario de registro)
                 -> assertSessionHasErrors([                     # Espera la existencia de un campo en el listado de errores de la sesión (en este caso el campo requerido)
                      'name'  => 'El nombre es obligatorio!'
                 ]);

        # Valida que la base de datos no registro este "nuevo" usuarios
        $this -> assertEquals( 0 , User :: count() );       # Segunda alternativa para validar que el registro no se ha realizado
        #$this -> assertDatabaseMissing( 'users', [         # Nombre de la tabla donde deseamos validar el registro
        #    'email' => 'melisasanchezz@correo.co'          # Email: que se espera no encontrar dentro de los registros en la base de datos
        #]);
    }
    /** @test */
    function the_email_is_required() {
        #$this -> withoutExceptionHandling();    # Permitirá que los ERRORES se puedan visualizar en la terminal

        # Envia petición de tipo post sin el campo requerido
        $this -> from( 'usuarios/nuevo' )                        # Indica URL de origen de la petición
              -> post( '/usuarios', [                            # Indica tipo de petición y ruta a la que se lanza la petición
                   'name' => 'Melisa Sánchez Zambrano',
                   'email' => '',
                   'password' => 'laravel'
              ]) -> assertRedirect( 'usuarios/nuevo' )           # La petición espera una redirección a la URL /usuarios/nuevo (el formulario de registro)
                 -> assertSessionHasErrors([                     # Espera la existencia de un campo en el listado de errores de la sesión (en este caso el campo requerido)
                   'email' => 'El correo electrónico es obligatorio!'
                 ]);

        # Valida que la base de datos no registro este "nuevo" usuarios
        $this -> assertEquals( 0 , User :: count() );       # Segunda alternativa para validar que el registro no se ha realizado

    }
    /** @test */
    function the_email_must_be_valid() {
        #$this -> withoutExceptionHandling();    # Permitirá que los ERRORES se puedan visualizar en la terminal

        # Envia petición de tipo post sin el campo requerido
        $this -> from( 'usuarios/nuevo' )                        # Indica URL de origen de la petición
              -> post( '/usuarios', [                            # Indica tipo de petición y ruta a la que se lanza la petición
                   'name' => 'Melisa Sánchez Zambrano',
                   'email' => 'correo-no-valido',
                   'password' => 'laravel'
              ]) -> assertRedirect( 'usuarios/nuevo' )           # La petición espera una redirección a la URL /usuarios/nuevo (el formulario de registro)
                 -> assertSessionHasErrors([                     # Espera la existencia de un campo en el listado de errores de la sesión (en este caso el campo requerido)
                   'email' => 'No es un correo electrónico válido!'
                 ]);

        # Valida que la base de datos no registro este "nuevo" usuarios
        $this -> assertEquals( 0 , User :: count() );       # Segunda alternativa para validar que el registro no se ha realizado

    }
    /** @test */
    function the_email_must_be_unique() {
        #$this -> withoutExceptionHandling();    # Permitirá que los ERRORES se puedan visualizar en la terminal

        factory( User :: class ) -> create([
            'email' => 'melisasanchezz@correo.co'
        ]);

        # Envia petición de tipo post sin el campo requerido
        $this -> from( 'usuarios/nuevo' )                        # Indica URL de origen de la petición
              -> post( '/usuarios', [                            # Indica tipo de petición y ruta a la que se lanza la petición
                   'name' => 'Melisa Sánchez Zambrano',
                   'email' => 'melisasanchezz@correo.co',
                   'password' => 'laravel'
              ]) -> assertRedirect( 'usuarios/nuevo' )           # La petición espera una redirección a la URL /usuarios/nuevo (el formulario de registro)
                 -> assertSessionHasErrors([                     # Espera la existencia de un campo en el listado de errores de la sesión (en este caso el campo requerido)
                   'email' => 'Este correo electrónico ya está registrado!'
                 ]);

        # Valida que la base de datos no registro este "nuevo" usuarios
        $this -> assertEquals( 1 , User :: count() );       # Segunda alternativa para validar que el registro no se ha realizado

    }
    /** @test */
    function the_password_is_required() {
        #$this -> withoutExceptionHandling();    # Permitirá que los ERRORES se puedan visualizar en la terminal

        # Envia petición de tipo post sin el campo requerido
        $this -> from( 'usuarios/nuevo' )                        # Indica URL de origen de la petición
              -> post( '/usuarios', [                            # Indica tipo de petición y ruta a la que se lanza la petición
                   'name' => 'Melisa Sánchez Zambrano',
                   'email' => 'melisasanchezz@correo.co',
                   'password' => ''
              ]) -> assertRedirect( 'usuarios/nuevo' )           # La petición espera una redirección a la URL /usuarios/nuevo (el formulario de registro)
                 -> assertSessionHasErrors([                     # Espera la existencia de un campo en el listado de errores de la sesión (en este caso el campo requerido)
                   'password' => 'La contraseña es obligatoria!'
                 ]);

        # Valida que la base de datos no registro este "nuevo" usuarios
        $this -> assertEquals( 0 , User :: count() );       # Segunda alternativa para validar que el registro no se ha realizado

    }
    /** @test */
    function it_password_must_be_min_size_seven_characters() {
        #$this -> withoutExceptionHandling();    # Permitirá que los ERRORES se puedan visualizar en la terminal

        # Envia petición de tipo post sin el campo requerido
        $this -> from( 'usuarios/nuevo' )                        # Indica URL de origen de la petición
              -> post( '/usuarios', [                            # Indica tipo de petición y ruta a la que se lanza la petición
                   'name' => 'Melisa Sánchez Zambrano',
                   'email' => 'melisasanchezz@correo.co',
                   'password' => '2deE2'                         # Solo tiene 5 caracteres y mínimo debe tener 7 caracteres
              ]) -> assertRedirect( 'usuarios/nuevo' )           # La petición espera una redirección a la URL /usuarios/nuevo (el formulario de registro)
                 -> assertSessionHasErrors([                     # Espera la existencia de un campo en el listado de errores de la sesión (en este caso el campo requerido)
                   'password' => 'La contraseña debe tener mínimo 7 caracteres!'
                 ]);

        # Valida que la base de datos no registro este "nuevo" usuarios
        $this -> assertEquals( 0 , User :: count() );       # Segunda alternativa para validar que el registro no se ha realizado

    }
    /** @test */
    function it_password_must_be_alphanumeric() {
        #$this -> withoutExceptionHandling();    # Permitirá que los ERRORES se puedan visualizar en la terminal

        # Envia petición de tipo post sin el campo requerido
        $this -> from( 'usuarios/nuevo' )                        # Indica URL de origen de la petición
              -> post( '/usuarios', [                            # Indica tipo de petición y ruta a la que se lanza la petición
                   'name' => 'Melisa Sánchez Zambrano',
                   'email' => 'melisasanchezz@correo.co',
                   'password' => '#er2?_3s'                      # No es alfanumérico
              ]) -> assertRedirect( 'usuarios/nuevo' )           # La petición espera una redirección a la URL /usuarios/nuevo (el formulario de registro)
                 -> assertSessionHasErrors([                     # Espera la existencia de un campo en el listado de errores de la sesión (en este caso el campo requerido)
                   'password'  => 'La contraseña debe ser alfanumérica!'
                 ]);

        # Valida que la base de datos no registro este "nuevo" usuarios
        $this -> assertEquals( 0 , User :: count() );       # Segunda alternativa para validar que el registro no se ha realizado

    }
    /***  ONLY UPDATE  ***/
    /** @test */
    function it_loads_the_edit_page() {
        $this -> withoutExceptionHandling();    # Permitirá que los ERRORES se puedan visualizar en la terminal

        $user = factory( User :: class ) -> create();

        # /usuarios/editar?id=5
        $this -> get( "/usuarios/{$user -> id}/editar" )        # /usuarios/5/editar
              -> assertStatus( 200 )
              -> assertViewIs( 'users.edit' )                   # Confirma que la vista esperada (usando en este caso el nombre de la ruta)
              -> assertSee( 'Edita usuario' )
              -> assertViewHas( 'user', function( $viewUser ) use ( $user ) {                           # Compara dos objetos: el usuario de la vista con el usuario que se tiene en la prueba
                  return $viewUser -> id == $user -> id;
              });
    }
    /** @test */
    function it_updates_a_new_user() {

        $this -> withoutExceptionHandling();    # Permitirá que los ERRORES se puedan visualizar en la terminal
        $user = factory( User :: class ) -> create();


        # Simula el envio de los datos por el método PUT a través del formulario
        $this -> put( "/usuarios/{$user -> id}", [           # Simula petición PUT a la URL /usuarios/<id-del-usuario>
            'name' => 'Juan Carlos Jiménez Gutiérrez',       # Datos enviados
            'email' => 'jcjimenez29@misena.edu.co',
            'password' => 'laravel'
        ]) -> assertRedirect( "/usuarios/{$user -> id}" );   # Verifica que haya una redirección al listado de usuarios usando el Helper Rout para hacerlo (Usuario ya editado)

        # Valida datos contra la base de datos
        $this -> assertCredentials([                        # El método assertCredentials() no requiere el nombre de la tabla siempre que usemos la tabla por defecto de la instalación de Laravel
            'name' => 'Juan Carlos Jiménez Gutiérrez',      # Campos/Columnas y los valores que esperamos encontrar
            'email' => 'jcjimenez29@misena.edu.co',
            'password' => 'laravel'                         # El método assertCredentials() perminte validad la contraseña de un usuario cosa que el método assertDatabaseHas() no permite. Además sin usar el método de encriptación.
        ]);
    }
    /** @test */
    function the_name_is_required_when_updating_a_user() {
        #$this -> withoutExceptionHandling();    # Permitirá que los ERRORES se puedan visualizar en la terminal

        $user = factory( User :: class ) -> create();

        # Envia petición de tipo post sin el campo requerido
        $this -> from( "usuarios/{$user -> id}/editar" )                        # Indica URL de origen de la petición
              -> put( "/usuarios/{$user -> id}", [                              # Indica tipo de petición y ruta a la que se lanza la petición
                   'name' => '',
                   'email' => 'melisasanchezz@correo.co',
                   'password' => 'laravel'
              ]) -> assertRedirect( "usuarios/{$user -> id}/editar" )           # La petición espera una redirección a la URL /usuarios/nuevo (el formulario de registro)
                 -> assertSessionHasErrors([                     # Espera la existencia de un campo en el listado de errores de la sesión (en este caso el campo requerido)
                      'name'  => 'El nombre es obligatorio!'
                 ]);

        # Valida que la base de datos no registro este usuario con correo
        $this -> assertDatabaseMissing( 'users', [         # Nombre de la tabla donde deseamos validar el registro
            'email' => 'melisasanchezz@correo.co'          # Email: que se espera no encontrar dentro de los registros en la base de datos
        ]);
    }
    /** @test */
    function the_email_is_required_when_updating_the_user() {

        #$this -> withoutExceptionHandling();    # Permitirá que los ERRORES se puedan visualizar en la terminal

        $user = factory( User :: class ) -> create([
            'name' => 'Maura Melissa Villanueva'                                # NOMBRE INICIAL
        ]);

        # Envia petición de tipo post sin el campo requerido
        $this -> from( "usuarios/{$user -> id}/editar" )                        # Indica URL de origen de la petición
              -> put( "/usuarios/{$user -> id}", [                              # Indica tipo de petición y ruta a la que se lanza la petición
                   'name' => 'Melisa Sánchez Zambrano',                         # NOMBRE ACTUALIZADO
                   'email' => '',
                   'password' => 'laravel'
              ]) -> assertRedirect( "usuarios/{$user -> id}/editar" )           # La petición espera una redirección a la URL /usuarios/nuevo (el formulario de registro)
                 -> assertSessionHasErrors([                     # Espera la existencia de un campo en el listado de errores de la sesión (en este caso el campo requerido)
                      'email'  => 'El correo electrónico es obligatorio!'
                 ]);

        # Valida que la base de datos no registro este usuario
        $this -> assertDatabaseMissing( 'users', [         # Nombre de la tabla donde deseamos validar el registro
            'name' => 'Melisa Sánchez Zambrano'            # name: que se espera no encontrar dentro de los registros en la base de datos
        ]);

    }
    /** @test */
    function the_email_must_be_valid_when_updating_the_user() {
        #$this -> withoutExceptionHandling();    # Permitirá que los ERRORES se puedan visualizar en la terminal

        $user = factory( User :: class ) -> create([
            'name' => 'Maura Melissa Villanueva'                                # NOMBRE INICIAL
        ]);

        # Envia petición de tipo post sin el campo requerido
        $this -> from( "usuarios/{$user -> id}/editar" )                        # Indica URL de origen de la petición
              -> put( "/usuarios/{$user -> id}", [                              # Indica tipo de petición y ruta a la que se lanza la petición
                   'name' => 'Melisa Sánchez Zambrano',                         # NOMBRE ACTUALIZADO
                   'email' => 'correo-no-valido',
                   'password' => 'laravel'
              ]) -> assertRedirect( "usuarios/{$user -> id}/editar" )           # La petición espera una redirección a la URL /usuarios/nuevo (el formulario de registro)
                 -> assertSessionHasErrors([                     # Espera la existencia de un campo en el listado de errores de la sesión (en este caso el campo requerido)
                      'email'  => 'No es un correo electrónico válido!'
                 ]);

        # Valida que la base de datos no registro este usuario
        $this -> assertDatabaseMissing( 'users', [         # Nombre de la tabla donde deseamos validar el registro
            'name' => 'Melisa Sánchez Zambrano'            # name: que se espera no encontrar dentro de los registros en la base de datos
        ]);

    }
    /** @test */
    function the_email_must_be_unique_when_updating_the_user() {

        #$this -> withoutExceptionHandling();    # Permitirá que los ERRORES se puedan visualizar en la terminal
        factory( User :: class ) -> create([
            'email' => 'correo-existente@gmail.com'
        ]);
        $user = factory( User :: class ) -> create([
            'email' => 'melisasanchezz@correo.co'                               # Correo valido inicial
        ]);

        # Envia petición de tipo post sin el campo requerido
        $this -> from( "usuarios/{$user -> id}/editar" )                        # Indica URL de origen de la petición
              -> put( "/usuarios/{$user -> id}", [                              # Indica tipo de petición y ruta a la que se lanza la petición
                   'name' => 'Melisa Sánchez Zambrano',
                   'email' => 'correo-existente@gmail.com',                       #
                   'password' => 'laravel'
              ]) -> assertRedirect( "usuarios/{$user -> id}/editar" )           # La petición espera una redirección a la URL /usuarios/nuevo (el formulario de registro)
                 -> assertSessionHasErrors([                     # Espera la existencia de un campo en el listado de errores de la sesión (en este caso el campo requerido)
                      'email'  => 'Este correo electrónico ya está registrado!'
                 ]);

        # Valida que la base de datos no registro este usuario
        #$this -> assertDatabaseMissing( 'users', [         # Nombre de la tabla donde deseamos validar el registro
        #    'name' => 'Melisa Sánchez Zambrano'            # name: que se espera no encontrar dentro de los registros en la base de datos
        #]);

    }
    /** @test */
    function the_email_can_stay_the_same_when_updating_the_user() {
        $same_email = 'melisasanchezz@correo.co';
        #$this -> withoutExceptionHandling();    # Permitirá que los ERRORES se puedan visualizar en la terminal

        $user = factory( User :: class ) -> create([
            'email' => $same_email
        ]);

        # Envia petición de tipo post sin el campo requerido
        $this -> from( "usuarios/{$user -> id}/editar" )                        # Indica URL de origen de la petición
              -> put( "/usuarios/{$user -> id}", [                              # Indica tipo de petición y ruta a la que se lanza la petición
                   'name' => 'Melisa Sánchez Zambrano',
                   'email' => $same_email,
                   'password' => '123456789'
              ]) -> assertRedirect( "usuarios/{$user -> id}" );  # La petición espera una redirección a la URL /usuarios (users.show)

        # Valida que la base de datos no registro este usuario
        $this -> assertDatabaseHas( 'users', [         # Nombre de la tabla donde deseamos validar el registro
            'name' => 'Melisa Sánchez Zambrano',
            'email' => $same_email                     # name: que se espera no encontrar dentro de los registros en la base de datos
        ]);

    }
    /** @test */
    function the_password_is_optional_when_updating_the_user() {
        $old_password = 'CLAVE_ANTERIOR';
        #$this -> withoutExceptionHandling();    # Permitirá que los ERRORES se puedan visualizar en la terminal

        $user = factory( User :: class ) -> create([
            'password' => bcrypt( $old_password )
        ]);

        # Envia petición de tipo post sin el campo requerido
        $this -> from( "usuarios/{$user -> id}/editar" )                        # Indica URL de origen de la petición
              -> put( "/usuarios/{$user -> id}", [                              # Indica tipo de petición y ruta a la que se lanza la petición
                   'name' => 'Melisa Sánchez Zambrano',
                   'email' => 'melisasanchezz@correo.co',
                   'password' => ''
              ]) -> assertRedirect( "usuarios/{$user -> id}" );  # La petición espera una redirección a la URL /usuarios (users.show)

        # Valida que la base de datos no registro este usuario con la clave antigua
        $this -> assertCredentials([         # Nombre de la tabla donde deseamos validar el registro
            'name' => 'Melisa Sánchez Zambrano',
            'email' => 'melisasanchezz@correo.co',           # name: que se espera no encontrar dentro de los registros en la base de datos
            'password' => $old_password                      # MUY IMPORTANTE!
        ]);

    }
    /** @test */
    function it_password_must_be_min_size_seven_characters_when_updating_the_user() {
        #$this -> withoutExceptionHandling();    # Permitirá que los ERRORES se puedan visualizar en la terminal

        $user = factory( User :: class ) -> create();

        # Envia petición de tipo post sin el campo requerido
        $this -> from( "usuarios/{$user -> id}/editar" )                        # Indica URL de origen de la petición
              -> put( "/usuarios/{$user -> id}", [                              # Indica tipo de petición y ruta a la que se lanza la petición
                   'name' => 'Melisa Sánchez Zambrano',
                   'email' => 'melisasanchezz@correo.co',                       #
                   'password' => '2deE2'                                        # Solo tiene 5 caracteres y mínimo debe tener 7 caracteres
              ]) -> assertRedirect( "usuarios/{$user -> id}/editar" )           # La petición espera una redirección a la URL /usuarios/nuevo (el formulario de registro)
                 -> assertSessionHasErrors([                     # Espera la existencia de un campo en el listado de errores de la sesión (en este caso el campo requerido)
                      'password' => 'La contraseña debe tener mínimo 7 caracteres!'
                 ]);

        # Valida que la base de datos no registro este usuario
        $this -> assertDatabaseMissing( 'users', [         # Nombre de la tabla donde deseamos validar el registro
            'email' => 'melisasanchezz@correo.co'            # name: que se espera no encontrar dentro de los registros en la base de datos
        ]);

    }
    /** @test */
    function it_password_must_be_alphanumeric_when_updating_the_user() {
        #$this -> withoutExceptionHandling();    # Permitirá que los ERRORES se puedan visualizar en la terminal

        $user = factory( User :: class ) -> create();

        # Envia petición de tipo post sin el campo requerido
        $this -> from( "usuarios/{$user -> id}/editar" )                        # Indica URL de origen de la petición
              -> put( "/usuarios/{$user -> id}", [                              # Indica tipo de petición y ruta a la que se lanza la petición
                   'name' => 'Melisa Sánchez Zambrano',
                   'email' => 'melisasanchezz@correo.co',                       #
                   'password' => '#er2?_3s'                      # No es alfanumérico
              ]) -> assertRedirect( "usuarios/{$user -> id}/editar" )           # La petición espera una redirección a la URL /usuarios/nuevo (el formulario de registro)
                 -> assertSessionHasErrors([                     # Espera la existencia de un campo en el listado de errores de la sesión (en este caso el campo requerido)
                      'password'  => 'La contraseña debe ser alfanumérica!'
                 ]);

        # Valida que la base de datos no registro este usuario
        $this -> assertDatabaseMissing( 'users', [         # Nombre de la tabla donde deseamos validar el registro
            'email' => 'melisasanchezz@correo.co'            # name: que se espera no encontrar dentro de los registros en la base de datos
        ]);

    }
    /** @test */
    function it_deletes_a_user() {
        $this -> withoutExceptionHandling();    # Permitirá que los ERRORES se puedan visualizar en la terminal

        $user = factory( User :: class ) -> create();

        $this -> delete( "/usuarios/{$user -> id}" )
              -> assertRedirect( 'usuarios' );

        $this -> assertDatabaseMissing( 'users', [          # Alternativa 1
            'id' => $user -> id
        ]);
        # $this -> assertSame( 0, User :: count() );        # Alternativa 2
    }
}
