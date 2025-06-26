<?php

namespace App\Console\Commands;

use App\Dominio\Mqtt\Broker;
use Illuminate\Console\Command;

class ListenerMqtt extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:listener-mqtt';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Listener Mqtt';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $broker = new Broker();

        $conectado = $broker->conectar();

        if($conectado) {
            $this->info("conectado");
        } else {
            $this->info("não conectado");
        }

        $broker->ouvirTemperatura('unifebe/si05');
    }
}
