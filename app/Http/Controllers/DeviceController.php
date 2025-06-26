<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{

    public function index()
    {
        $devices = Device::all();
        return view('device.index', compact('devices'));
    }

    public function create()
    {
        return view('device.create');
    }

    public function store(Request $request)
    {

        $device = new Device();
        $device->nome = $request->nome;
        $device->save();

        return redirect()->route('device.index');
    }

    public function edit($codigo)
    {
        $device = Device::find($codigo);

        return view('device.edit', compact('device'));
    }

    public function update(Request $request, $codigo)
    {

        $device = Device::find($codigo);
        $device->nome = $request->nome;
        $device->save();

        return redirect()->route('device.index');
    }

    public function destroy($codigo)
    {
        $device = Device::find($codigo);
        $device->delete();

        return redirect()->route('device.index');
    }
}
