@extends( 'layout' )         {{-- Extiende al archivo layout.blade.php Template del sitio --}}

@section( 'title', 'Crear usuario' )        {{-- Define la sección 'title' (forma abreviada) --}}
@section( 'content' )        {{-- Define la sección 'content' --}}

    <h2>Crear usuario</h2>
    <form action="{{ url( 'usuarios' ) }}" method="post">
        {!! csrf_field() !!}
        <button type="submit">Crear usuario</button>
    </form>

    <p><a href="{{ route( 'users.index' ) }}">Regresar</a></p>

@endsection
