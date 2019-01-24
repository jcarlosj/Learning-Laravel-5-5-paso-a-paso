@extends( 'layout' )         {{-- Extiende al archivo layout.blade.php Template del sitio --}}

@section( 'title', $user -> name )        {{-- Define la sección 'title' (forma abreviada) --}}
@section( 'content' )        {{-- Define la sección 'content' --}}

<h2>Usuario #{{ $user -> id }}</h2>
<p><b>Nombre:</b> {{ $user -> name }}</p>
<p><b>Correo:</b> {{ $user -> email }}</p>
<p><a href="{{ url( "/usuarios" ) }}">Regresar</a></p>

@endsection
