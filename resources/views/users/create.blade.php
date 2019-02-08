@extends( 'layout' )         {{-- Extiende al archivo layout.blade.php Template del sitio --}}

@section( 'title', 'Crear usuario' )        {{-- Define la sección 'title' (forma abreviada) --}}
@section( 'content' )        {{-- Define la sección 'content' --}}

    <div class="card">
        <h4 class="card-header">Crea usuario nuevo</h4>
        <div class="card-body">

            {{-- Valida si existen errores en la sesión para esta vista  --}}
            @if( $errors -> any() )
                <div class="alert alert-danger">
                    <h6>Por favor corrige los campos que se indican</h6>
                </div>
            @endif

            <form action="{{ url( 'usuarios' ) }}" method="post">
                {!! csrf_field() !!}

                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input id="name" class="form-control" type="text" name="name" placeholder="Ej: Juliana Puerta" value="{{ old( 'name' ) }}">
                    @if( $errors -> has( 'name' ) )
                        {{-- Imprime el primer error dentro del campo nombre --}}
                        <small class="form-text text-muted">{{ $errors -> first( 'name' ) }}</small>
                    @endif
                </div>
                <div class="form-group">
                    <label for="email">Correo</label>
                    <input id="email" class="form-control" type="email" name="email" placeholder="Ej: julipuerta@correo.co" value="{{ old( 'email' ) }}">
                    @if( $errors -> has( 'email' ) )
                        {{-- Imprime el primer error dentro del campo email --}}
                        <small class="form-text text-muted">{{ $errors -> first( 'email' ) }}</small>
                    @endif
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input id="password" class="form-control" type="password" name="password" placeholder="6 o más caracteres">
                    @if( $errors -> has( 'password' ) )
                        {{-- Imprime el primer error dentro del campo password --}}
                        <small class="form-text text-muted">{{ $errors -> first( 'password' ) }}</small>
                    @endif
                </div>
                <button class="btn btn-primary" type="submit">Crear usuario</button>
                <a class="btn btn-link" href="{{ route( 'users.index' ) }}">Regresar</a>
            </form>

        </div>
    </div>

@endsection
