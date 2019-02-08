@extends( 'layout' )         {{-- Extiende al archivo layout.blade.php Template del sitio --}}

@section( 'title', "Listado de $title " )        {{-- Define la sección 'title' (forma abreviada) --}}
@section( 'content' )        {{-- Define la sección 'content' --}}

<div class="d-flex justify-content-between align-items-end mb-3">
    <h2 class="pb-1">{{ $title }}</h2>
    <p><a class="btn btn-primary" href="{{ route( 'users.create' ) }}">Crear usuario</a></p>
</div>

{{-- Valida si la colección de usuarios no está vacía --}}
@if( $users -> isnotEmpty() )
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nombre</th>
          <th scope="col">Correo</th>
          <th scope="col">Acciones</th>
        </tr>
      </thead>
      <tbody>
          @foreach( $users as $user )
          <tr>
            <th scope="row">{{ $user -> id }}</th>
            <td>{{ $user -> name }}</td>
            <td>{{ $user -> email }}</td>
            <td>
                <div class="float-left w-75">
                    <a class="btn btn-link w-25" href="{{ route( 'users.show', [ 'user' => $user -> id ] ) }}"><span class="oi oi-eye"></span></a>   {{-- Forma 1: pasando explicitamente el ID del usuario en un Array Asociativo --}}
                    <a class="btn btn-link w-25" href="{{ route( 'users.edit', [ 'user' => $user ] ) }}"><span class="oi oi-pencil"></span></a>      {{-- Forma 2: pasando el objeto Eloquent en un Array Asociativo --}}
                </div>
                <form class="float-left w-25" action="{{ route( 'users.delete', $user ) }}" method="post">         {{-- Forma 3: pasando solo el objeto Eloquent (Redireccionando la acción usando el router de Delete) --}}
                    {!! method_field( 'DELETE' ) !!}                                       {{-- Agrega campo oculto con el nombre _method y el valor DELETE --}}
                    {!! csrf_field() !!}
                    <button class="btn btn-link" type="submit"><span class="oi oi-trash"></span></button>
                </form>
            </td>
          </tr>
          @endforeach
      </tbody>
    </table>
@else
    <p>No hay usuarios registrados!</p>
@endif

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
