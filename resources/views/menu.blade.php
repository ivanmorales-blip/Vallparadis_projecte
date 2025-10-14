<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
   <!--  <script src="https://cdn.tailwindcss.com"></script>-->
   <!-- @vite('resources/css/app.css')-->
</head>
<body>
<!---->
@extends('layouts.template')


@section('contingut')

   

    <h1><a href="{{ route('centers.index') }}">Listar centros</a></h1>
    <h1><a href="{{ route('centers.create') }}">Alta centro</a></h1>
    <h1><a href="{{ route('profesional.index') }}">Listar Profesionals</a></h1>
    <h1><a href="{{ route('profesional.create') }}">Alta Profesionals</a></h1>
    <h1><a href="{{ route('projectes_comissions.index') }}">Listar Projectes i comissions</a></h1>
    <h1><a href="{{ route('projectes_comissions.create') }}">Alta Projectes i comissions</a></h1>

@endsection
<!---->
</body>
</html>