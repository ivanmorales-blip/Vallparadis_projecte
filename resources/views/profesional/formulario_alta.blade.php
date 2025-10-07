<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulari Center</title>
</head>
<body>
    <h1>Formulari del Center</h1>

    <form action="{{route('insertProfesional')}}" method="POST">
        @csrf

        <!-- Nom -->
        <div>
            <label for="nom">Nom *</label>
            <input id="nom" name="nom" type="text" required>
        </div>

        <!-- Cognom -->
        <div>
            <label for="cognom">Cognom *</label>
            <input id="cognom" name="cognom" type="text" required>
        </div>

        <!-- Telèfon -->
        <div>
            <label for="telefon">Telèfon *</label>
            <input id="telefon" name="telefon" type="tel" required>
        </div>

        <!-- Correu -->
        <div>
            <label for="email">Correu electrònic *</label>
            <input id="email" name="email" type="text" required>
        </div>

        <!-- Adreça -->
        <div>
            <label for="adreça">Adreça</label>
            <textarea id="adreça" name="adreça" rows="2"></textarea>
        </div>

        <!-- Estat -->
        <div>
            <label for="estat">Estat *</label>
            <select id="estat" name="estat" required>
                <option value="">-- Selecciona un estat --</option>
                <option value="actiu">Actiu</option>
                <option value="inactiu">Inactiu</option>
            </select>
        </div>

        <!-- Center -->
        <div>
            <label for="id_center">Center</label>
            <input id="id_center" name="id_center" type="text">
        </div>

        <!-- Botons -->
        <div>
            <button type="submit">Enviar</button>
            <button type="reset">Netejar</button>
        </div>
    </form>
</body>
</html>
