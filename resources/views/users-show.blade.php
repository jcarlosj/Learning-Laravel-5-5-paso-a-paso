@extends( 'layout' )         {{-- Extiende al archivo layout.blade.php Template del sitio --}}

@section( 'content' )        {{-- Define la sección 'content' --}}

<h2>ID de Usuario</h2>
<p>id: {{ $id }}</p>

@endsection
