<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Projeto IoT</title>
</head>
<body>

<form method="post" action="{{route('device.update', $device->codigo)}}">
    <label>Nome:</label>
    <input type="text" name="nome" id="nome" value="{{$device->nome}}" />

    {{ method_field('PATCH') }}
    @csrf

    <br/><br/>
    <button>Editar</button>
</form>

</body>
</html>
