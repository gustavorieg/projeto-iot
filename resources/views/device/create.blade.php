<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Projeto IoT</title>
</head>
<body>

<form method="post" action="{{route('device.store')}}">
    <label>Nome:</label>
    <input type="text" name="nome" id="nome" />

    @csrf

    <br/><br/>
    <button>Adicionar</button>
</form>

</body>
</html>
