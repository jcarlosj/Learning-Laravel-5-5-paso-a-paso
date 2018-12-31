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
        <h2>Buscar</h2>
        <input type="text" />
        <button type="button">Buscar</button>

        <h2>Últimas publicaciones</h2>
        <ul>
            <li><a href="">publicación 1</a></li>
            <li><a href="">publicación 2</a></li>
            <li><a href="">publicación 3</a></li>
            <li><a href="">publicación 4</a></li>
        </ul>
    </div>
</div>

@include( 'footer' )
