<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
        <!-- El atributo borde aqui no es correcto, debería estar en el css-->
        <h1>Listado profesionales</h1>
        <table border='1'>
            <td>Nom</td>
            <td>Cognom</td>
            <td>Telefon</td>
            <td>Emal</td>
            <td>Adreça</td>
            <td>Estat</td>
            @foreach ($profesional as $profesional)
            <tr>
                <td>{{ $profesional->nom }}</td>
                <td>{{ $profesional->cognom }}</td>
                <td>{{ $profesional->telefon }}</td>
                <td>{{ $profesional->email }}</td>
                <td>{{ $profesional->adreça }}</td>
                <td>{{ $profesional->estat ? 'Activo' : 'Inactivo' }}</td>
                
                <td>
                    <a href="{{ route('profesional.edit', $profesional) }}">Editar</a>
                </td>
                
                <td>
                @if ($profesional->estat)
                    <form action="{{ route('profesional.destroy', $profesional) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Desactivar</button>
                    </form>
                @else
                    <form action="{{ route('profesional.active', $profesional) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit">Activar</button>
                    </form>
                @endif
                
            </tr>
            @endforeach
        </table>
    </table>
    <h3><a href="{{route('menu')}}"> Volver a menú</a></h3>
</body>
</html>