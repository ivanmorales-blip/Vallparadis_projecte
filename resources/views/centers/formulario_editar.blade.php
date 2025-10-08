<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Edición centro </h1>

    <form action="{{route('centers.update', $center)}}" method="POST">
        @csrf
        @method('PUT')
        Nom: <input type="text" name="nom" value='{{$center->nom}}'><br>
        Direcció: <input type="text" name="adreça" value='{{$center->adreça}}'><br>
        Telefono: <input type="text" name="Telefon" value='{{$center->telefon}}'><br>
        Mail: <input type="text" name="mail" value='{{$center->mail}}'><br>
        <input type="submit" value="Aceptar">
    </form>
</body>
</html>