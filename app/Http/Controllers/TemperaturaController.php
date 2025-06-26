<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Temperatura;

class TemperaturaController extends Controller
{
    public function index()
{
    return view('temperaturas.index');
}

public function dados(Request $request)
{
    $query = Temperatura::query();

    if ($request->filled('inicio') && $request->filled('fim')) {
        $inicio = \Carbon\Carbon::parse($request->inicio)->startOfDay();
        $fim = \Carbon\Carbon::parse($request->fim)->endOfDay();
        $query->whereBetween('data', [$inicio, $fim]);
    }

    $temperaturas = $query->orderBy('data')->get();

    return response()->json([
        'labels' => $temperaturas->pluck('data')->map(fn($d) => \Carbon\Carbon::parse($d)->format('d/m H:i')),
        'dados' => $temperaturas->pluck('leitura_temperatura')
    ]);
}

}
