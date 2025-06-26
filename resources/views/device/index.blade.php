<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Projeto IoT</title>
</head>
<body>

    <a href="{{route('device.create')}}">Novo</a>

    <table width="80%">
        <thead>
        <tr>
            <td>Código</td>
            <td>Nome</td>
            <td>Ações</td>
        </tr>
        </thead>
        <tbody>

        @foreach($devices as $device)
            <tr>
                <td>{{$device->codigo}}</td>
                <td>{{$device->nome}}</td>
                <td>
                    <a href="{{route('device.edit', $device->codigo)}}">Editar</a>

                    <form action="{{ route('device.destroy',$device->codigo) }}" method="POST" class="ps-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Apagar
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

</body>
</html>
