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
        Centre: <select name="id_center" id="id_center" required>
                <option value="">Centre</option>
                @foreach ($centre as $centre)
                    <option value="{{ $centre->id }}">{{ $centre->nom }}</option>
                @endforeach
            </select>
        <br>
        Talla Samarreta: <select name="talla_samarreta" id="talla_samarreta" required>
            <option value="">-- Selecciona --</option>
            @foreach (['XS', 'S', 'M', 'L', 'XL', 'XXL', '3XL', '4XL'] as $size)
                <option value="{{ $size }}">{{ $size }}</option>
            @endforeach
        </select>
         <br>
        Talla Pantalons: <select name="talla_pantalons" id="talla_pantalons" required>
            <option value="">-- Selecciona --</option>
            @for ($i = 36; $i <= 56; $i += 2)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
         <br>
        Talla sabates: <select name="talla_sabates" id="talla_sabates" required>
            <option value="">-- Selecciona --</option>
            @for ($i = 35; $i <= 47; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
         <br>
         
        <input type="submit" value="Aceptar">
    </form>
</body>
</html>
