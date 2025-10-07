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
            @foreach ($centers as $center)
            <tr>
                <td>{{ $center->nom }}</td>
                <td>{{ $center->adreça }}</td>
                <td>
                    <a href="{{ route('centers.edit', $center) }}">Editar</a>
                </td>
            </tr>
            @endforeach
        </table>
    </table>
    <h3><a href="{{route('menu')}}"> Volver a menú</a></h3>
</body>
</html>