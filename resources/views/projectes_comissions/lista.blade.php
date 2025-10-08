<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Llista de Projectes i Comissions</title>
</head>
<body>
    <h1>LLista de Projectes i Comissions</h1>

    

    @if (session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif

    <table border="1">
        <head>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Tipus</th>
                <th>Data Inici</th>
                <th>Accions</th>
            </tr>
        <thead>
        <body>
            @foreach($projectes as $projecte)
                <tr>
                    <td>{{ $projecte->id }}</td>
                    <td>{{ $projecte->nom }}</td>
                    <td>{{ $projecte->tipus }}</td>
                    <td>{{ $projecte->data_inici }}</td>
                    <td>{{ $projecte->profesional_id }}</td>
                    <td>{{ $projecte->centre_id }}</td>
                    <td>
                        <a href="{{ route('projectes_comissions.edit', $projecte) }}">Editar</a> |
                    </td>
                </tr>
            @endforeach
        </body>
    </table>
    <h3><a href="{{ route('projectes_comissions.create') }}">Afegir Projecte/Comissió</a></h3>
    <h3><a href="{{route('menu')}}"> Volver a menú</a></h3>
</body>
</html>