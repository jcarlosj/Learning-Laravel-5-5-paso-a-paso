@extends( 'layout' )         {{-- Extiende al archivo layout.blade.php Template del sitio --}}

@section( 'title', 'Crear usuario' )        {{-- Define la sección 'title' (forma abreviada) --}}
@section( 'content' )        {{-- Define la sección 'content' --}}

    <h2>Crear usuario</h2>
    @if( $errors -> any() )
        <p>Hay errores!</p>
        {{ dd( $errors ) }}
    @endif
    <form action="{{ url( 'usuarios' ) }}" method="post">
        {!! csrf_field() !!}
        <label for="name">Nombre</label>
        <input id="name" type="text" name="name" placeholder="Ej: Juliana Puerta">
        <br />
        <label for="email">Correo</label>
        <input id="email" type="email" name="email" placeholder="Ej: julipuerta@correo.co">
        <br />
        <label for="password">Contraseña</label>
        <input id="password" type="password" name="password" placeholder="6 o más caracteres">
        <br />
        <button type="submit">Crear usuario</button>
    </form>

    <p><a href="{{ route( 'users.index' ) }}">Regresar</a></p>

@endsection
