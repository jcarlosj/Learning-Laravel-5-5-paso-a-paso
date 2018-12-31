@extends( 'layout' )         {{-- Extiende al archivo layout.blade.php Template del sitio --}}

@section( 'content' )        {{-- Define la sección 'content' --}}

<div class="row mt-3">
    <div class="col-8">
        <h2>ID de Usuario</h2>
        <p>id: {{ $id }}</p>
    </div>
    <div class="col-4">
        @include( 'sidebar' )
    </div>
</div>

@endsection
