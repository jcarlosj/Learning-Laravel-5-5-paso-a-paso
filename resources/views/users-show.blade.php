@include( 'header' )

<div class="row mt-3">
    <div class="col-8">
        <h2>ID de Usuario</h2>
        <p>id: {{ $id }}</p>
    </div>
    <div class="col-4">
        @include( 'sidebar' )
    </div>
</div>

@include( 'footer' )
