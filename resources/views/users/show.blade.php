@extends( 'layout' )         {{-- Extiende al archivo layout.blade.php Template del sitio --}}

@section( 'title', $user -> name )        {{-- Define la sección 'title' (forma abreviada) --}}
@section( 'content' )        {{-- Define la sección 'content' --}}

<div class="card">
  <h4 class="card-header">Usuario #{{ $user -> id }}</h4>
  <div class="card-body">
      <h5 class="card-title">Datos del usuario</h5>
    <p class="card-text"><b>Nombre:</b> {{ $user -> name }}</p>
    <p class="card-text"><b>Correo:</b> {{ $user -> email }}</p>
    <a class="btn btn-primary" href="{{ route( 'users.index' ) }}">Regresar</a>
  </div>
</div>

@endsection
