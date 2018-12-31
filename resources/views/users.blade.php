@include( 'header' )

<div class="row mt-3">
    <div class="col-8">
        <h2>{{ $title }}</h2>
        <ul>
            @forelse ( $users as $key => $user )
                <li>{{ $user }}</li>
            @empty
                <li>No hay usuarios registrados</li>
            @endforelse
        </ul>
    </div>
    <div class="col-4">
        @include( 'sidebar' )
    </div>
</div>

@include( 'footer' )
