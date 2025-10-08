<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <h1>Listado centros</h1>    
    <table border='1'>
        @foreach ($centers as $center)
        <tr>
            <td>{{ $center->nom }}</td>
            <td>{{ $center->adreça }}</td>
            <td>
                <a href="{{ route('centers.edit', $center) }}">Editar</a>
            </td>
            <td>{{ $center->activo ? 'Activo' : 'Inactivo' }}</td>
            <td>
                @if ($center->activo)
                    <form action="{{ route('centers.destroy', $center) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Desactivar</button>
                    </form>
                @else
                    <form action="{{ route('centers.active', $center) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit">Activar</button>
                    </form>
                @endif
            </td>
        </tr>
        @endforeach
    </table>
    <h3><a href="{{route('menu')}}"> Volver a menú</a></h3>
</body>
</html