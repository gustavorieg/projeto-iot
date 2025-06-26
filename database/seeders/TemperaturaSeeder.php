<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TemperaturaSeeder extends Seeder
{
    public function run()
    {
        $inicio = Carbon::now()->subDays(7); 
        
        for ($i = 0; $i < 100; $i++) {
            DB::table('temperatura')->insert([
                'data' => $inicio->copy()->addHours($i),
                'leitura_temperatura' => rand(15, 40) + (rand(0, 99) / 100.0)
            ]);
        }
    }
}

