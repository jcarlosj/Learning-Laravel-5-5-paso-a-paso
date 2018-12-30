@include( 'header' )

<h2>{{ $title }}</h2>
<ul>
    @forelse ( $users as $key => $user )
        <li>{{ $user }}</li>
    @empty
        <li>No hay usuarios registrados</li>
    @endforelse
</ul>

@include( 'footer' )
