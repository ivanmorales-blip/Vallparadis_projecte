<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Edición centro </h1>

    <form action="{{route('profesional.update', $profesional)}}" method="POST">
        @csrf
        @method('PUT')
        Nom: <input type="text" name="nom" value='{{$profesional->nom}}'><br>
        Cognom: <input type="text" name="cognom" value='{{$profesional->cognom}}'><br>
        Telefon: <input type="text" name="telefon" value='{{$profesional->telefon}}'><br>
        Email: <input type="text" name="email" value='{{$profesional->email}}'><br>
        Adreça: <input type="text" name="cognom" value='{{$profesional->cognom}}'><br>
        <select name="id_center" id="id_center" required>
                <option value="">Centre</option>
                @foreach ($centre as $centre)
                    <option value="{{ $centre->id }}">{{ $centre->nom }}</option>
                @endforeach
            </select>
        <br>
        <input type="submit" value="Aceptar">
    </form>
</body>
</html>
