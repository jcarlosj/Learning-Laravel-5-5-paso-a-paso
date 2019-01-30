@extends( 'layout' )         {{-- Extiende al archivo layout.blade.php Template del sitio --}}

@section( 'title', 'Crear usuario' )        {{-- Define la sección 'title' (forma abreviada) --}}
@section( 'content' )        {{-- Define la sección 'content' --}}

    <h2>Crea usuario nuevo</h2>

    {{-- Valida si existen errores en la sesión para esta vista  --}}
    @if( $errors -> any() )
        <div class="alert alert-danger">
            <h5>Por favor corrige los campos que se indican</h5>
        </div>
    @endif

    <form action="{{ url( 'usuarios' ) }}" method="post">
        {!! csrf_field() !!}
        <label for="name">Nombre</label>
        <input id="name" type="text" name="name" placeholder="Ej: Juliana Puerta" value="{{ old( 'name' ) }}">
        @if( $errors -> has( 'name' ) )
            {{-- Imprime el primer error dentro del campo nombre --}}
            <small class="alert alert-danger">{{ $errors -> first( 'name' ) }}</small>
        @endif
        <br />
        <label for="email">Correo</label>
        <input id="email" type="email" name="email" placeholder="Ej: julipuerta@correo.co" value="{{ old( 'email' ) }}">
        <br />
        <label for="password">Contraseña</label>
        <input id="password" type="password" name="password" placeholder="6 o más caracteres">
        <br />
        <button type="submit">Crear usuario</button>
    </form>

    <p><a href="{{ route( 'users.index' ) }}">Regresar</a></p>

@endsection
