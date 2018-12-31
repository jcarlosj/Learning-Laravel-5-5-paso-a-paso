@extends( 'layout' )         {{-- Extiende al archivo layout.blade.php Template del sitio --}}

@section( 'title', "Contacto " )        {{-- Define la sección 'title' (forma abreviada) --}}
@section( 'content' )        {{-- Define la sección 'content' --}}

<h2>Contactenos</h2>
<form>
   <p>Envianos tu mensaje</p>
   <input type="nombre" /><br />
   <input type="email" /><br />
   <textarea></textarea><br />
   <button type="button">Enviar</button>
</form>

@endsection
