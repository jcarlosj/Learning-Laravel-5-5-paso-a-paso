@extends( 'layout' )         {{-- Extiende al archivo layout.blade.php Template del sitio --}}

@section( 'content' )        {{-- Define la sección 'content' --}}

<div class="row mt-3">
    <div class="col-8">
        <h2>Contactenos</h2>
        <form>
           <p>Envianos tu mensaje</p>
           <input type="nombre" /><br />
           <input type="email" /><br />
           <textarea></textarea><br />
           <button type="button">Enviar</button>
        </form>
    </div>
    <div class="col-4">
        @include( 'sidebar' )
    </div>
</div>

@endsection
