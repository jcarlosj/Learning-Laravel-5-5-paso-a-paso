@extends( 'layout' )         {{-- Extiende al archivo layout.blade.php Template del sitio --}}

@section( 'title', "Listado de $title " )        {{-- Define la sección 'title' (forma abreviada) --}}
@section( 'content' )        {{-- Define la sección 'content' --}}

<h2>{{ $title }}</h2>
<ul>
    @forelse ( $users as $key => $user )
        <li>{{ $user -> name }}, <small>{{ $user -> email }}</small></li>
    @empty
        <li>No hay usuarios registrados</li>
    @endforelse
</ul>

@endsection

@section( 'sidebar' )        {{-- En este caso reescribe la definición de la sección 'sidebar' para esta vista --}}
    @parent
    <!--
        <h2>Detalles de la subscripción</h2>
        <p>Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        <input type="text" placeholder="ej: tu@correo.co" />
        <button type="button">Subscribirse</button>
    -->
@endsection
