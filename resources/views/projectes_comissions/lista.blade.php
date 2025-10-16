<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Tipus</th>
            <th>Data Inici</th>
            <th>Profesional</th>
            <th>Centre</th>
            <th>Estat</th>
            <th>Accions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($projectes as $projecte)
            <tr>
                <td>{{ $projecte->id }}</td>
                <td>{{ $projecte->nom }}</td>
                <td>{{ $projecte->tipus }}</td>
                <td>{{ $projecte->data_inici }}</td>
                <td>{{ $projecte->profesional->nom ?? '' }}</td>
                <td>{{ $projecte->centre->nom ?? '' }}</td>
                <td>{{ $projecte->estat ? 'Actiu' : 'Inactiu' }}</td>
                <td>
                    <a href="{{ route('projectes_comissions.edit', $projecte) }}">Editar</a>

                    @if($projecte->estat)
                        <form action="{{ route('projectes_comissions.destroy', $projecte) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Desactivar</button>
                        </form>
                    @else
                        <form action="{{ route('projectes_comissions.active', $projecte) }}" method="POST" style="display:inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit">Activar</button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<h3><a href="{{ route('menu') }}">Volver a menú</a></h3>
</body>
</html>
