<!DOCTYPE html>
<html lang="es" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=0, maximum-scale=1.0, min-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Listado de usuarios</title>
    </head>
    <body>
        <h2>{{ $title }}</h2>
        <ul>
            @forelse ( $users as $key => $user )
                <li>{{ $user }}</li>
            @empty
                <li>No hay usuarios registrados</li>
            @endforelse
        </ul>
    </body>
</html>
