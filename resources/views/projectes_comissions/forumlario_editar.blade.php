<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Editar Projecte o Comissió</title>
</head>
<body>
    <h1>Editar Projecte o Comissió</h1>

    <form action="{{ route('projectes_comissions.update', $projecte->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Nom:</label>
        <input type="text" name="nom" value="{{ $projecte->nom }}" required><br>

        <label>Tipus:</label>
        <input type="text" name="tipus" value="{{ $projecte->tipus }}" required><br>

        <label>Data Inici:</label>
        <input type="date" name="data_inici" value="{{ $projecte->data_inici }}" required><br>

        <label>ID Professional:</label>
        <input type="number" name="profesional_id" value="{{ $projecte->profesional_id }}" required><br>

        <label>Descripció:</label>
        <textarea name="descripcio" required>{{ $projecte->descripcio }}</textarea><br>

        <label>Observacions:</label>
        <textarea name="observacions">{{ $projecte->observacions }}</textarea><br>

        <label>ID Centre:</label>
        <input type="number" name="centre_id" value="{{ $projecte->centre_id }}" required><br>

        <button type="submit">Actualitzar</button>
    </form>
</body>
</html>

