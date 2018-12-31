@extends( 'layout' )         {{-- Extiende al archivo layout.blade.php Template del sitio --}}

@section( 'content' )        {{-- Define la sección 'content' --}}

<h2>{{ $title }}</h2>
<ul>
    @forelse ( $users as $key => $user )
        <li>{{ $user }}</li>
    @empty
        <li>No hay usuarios registrados</li>
    @endforelse
</ul>

@endsection
