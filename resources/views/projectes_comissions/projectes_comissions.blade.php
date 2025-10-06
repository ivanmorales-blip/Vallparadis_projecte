<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="/activitats" method="POST">
    @csrf
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <div>
      <label for="nom">Nom:</label>
      <input type="text" id="nom" name="nom" required>
    </div>

    <div>
      <label for="tipus">Tipus:</label>
      <input type="text" id="tipus" name="tipus" required>
    </div>

    <div>
      <label for="data_inici">Data inici:</label>
      <input type="date" id="data_inici" name="data_inici" required>
    </div>

    <div>
      <label for="profesional_id">ID Professional:</label>
      <input type="number" id="profesional_id" name="profesional_id" required>
    </div>

    <div>
      <label for="descripcio">Descripció:</label>
      <textarea id="descripcio" name="descripcio" required></textarea>
    </div>

    <div>
      <label for="observacions">Observacions:</label>
      <textarea id="observacions" name="observacions"></textarea>
    </div>

    <div>
      <label for="centre_id">ID Centre:</label>
      <input type="number" id="centre_id" name="centre_id" required>
    </div>

    <button type="submit">Guardar</button>
  </form>
</body>
</html>