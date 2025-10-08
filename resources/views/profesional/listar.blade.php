<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
        <!-- El atributo borde aqui no es correcto, debería estar en el css-->

        <table border='1'>
        <table>
            @foreach ($profesional as $profesional)
            <tr>
                <td>{{ $profesional->nom }}</td>
                <td>{{ $profesional->cognom }}</td>
                <td>{{ $profesional->telefon }}</td>
                <td>{{ $profesional->email }}</td>
                <td>{{ $profesional->adreça }}</td>
                <td>{{ $profesional->estat }}</td>
                <td>
                    <a href="{{ route('profesional.edit', $profesional) }}">Editar</a>
                </td>
            </tr>
            @endforeach
        </table>
    </table>
    <h3><a href="{{route('menu')}}"> Volver a menú</a></h3>
</body>
</html>