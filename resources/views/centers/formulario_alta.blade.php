<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="{{route('centers.store')}}" method="POST">
    <!-- Nom -->
    @csrf
    <div>
        <label for="nom">Nom *</label>
        <input id="nom" name="nom" type="text" required>
    </div>


    <!-- Adreça -->
    <div>
        <label for="adreça">Adreça</label>
        <textarea id="adreça" name="adreça" rows="2"></textarea>
    </div>


    <!-- Telefon -->
    <div>
        <label for="telefon">Telèfon *</label>
        <input id="telefon" name="telefon" type="tel" required>
    </div>


    <!-- Mail -->
    <div>
        <label for="mail">Correu electrònic *</label>
        <input id="mail" name="mail" type="email" required>
    </div>


    <div>
        <button type="submit">Enviar</button>
        <button type="reset">Netejar</button>
    </div>
</form>
</body>
</html>