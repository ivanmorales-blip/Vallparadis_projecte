<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Editar Projecte o Comissió</title>
</head>
<body>
    <h1>Editar Projecte o Comissió</h1>

    <form action="{{ route('projectes_comissions.update', $projectes_comission) }}" method="POST">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
        @csrf
        @method('PUT')

        <label>Nom:</label>
        <input type="text" name="nom" value="{{ $projectes_comission->nom }}" required><br>

        <label>Tipus:</label>
        <input type="text" name="tipus" value="{{ $projectes_comission->tipus }}" required><br>

        <label>Data Inici:</label>
        <input type="date" name="data_inici" value="{{ $projectes_comission->data_inici }}" required><br>

        <label>ID Professional:</label>
        <input type="number" name="profesional_id" value="{{ $projectes_comission->profesional_id }}" required><br>

        <label>Descripció:</label>
        <textarea name="descripcio" required>{{ $projectes_comission->descripcio }}</textarea><br>

        <label>Observacions:</label>
        <textarea name="observacions">{{ $projectes_comission->observacions }}</textarea><br>

        <label>ID Centre:</label>
        <input type="number" name="centre_id" value="{{ $projectes_comission->centre_id }}" required><br>

        <button type="submit">Actualitzar</button>
    </form>
</body>
</html>

