<?php

namespace App\Dominio\Mqtt;

use App\Models\Temperatura;
use Illuminate\Support\Facades\Config;

class Broker
{

    public $server;
    public $port;
    public $username;
    public $password;
    public $tls;
    public $clientId;
    private $mqtt;

    public function __construct($clientId = null, $getConfig = true)
    {

        if ($clientId == null) {
            $this->clientId = rand(100, 5000);
        } else {
            $this->clientId = $clientId;
        }

        if ($getConfig) {
            $this->setConfig();
        }

    }

    private function setConfig()
    {

        $this->server = Config::get('queue.connections.mqtt.server');
        $this->port = Config::get('queue.connections.mqtt.port');
        $this->username = Config::get('queue.connections.mqtt.username');
        $this->password = Config::get('queue.connections.mqtt.password');
        $this->tls = Config::get('queue.connections.mqtt.tls');

    }

    public function conectar($timeout = 3, $cleanSession = true, $self = true)
    {

        try {
            $this->mqtt = new \PhpMqtt\Client\MqttClient($this->server, $this->port, $this->clientId);

            $connectionSettings = (new \PhpMqtt\Client\ConnectionSettings)
                ->setConnectTimeout($timeout)
                ->setUseTls($this->tls)
                ->setTlsSelfSignedAllowed($self);

            $this->mqtt->connect($connectionSettings, $cleanSession);

            return true;

        } catch (\Exception $e) {
            echo $e->getMessage();
            return false;
        }

    }

    public function desconectar()
    {
        try {
            $this->mqtt->disconnect();
        } catch (\Exception $e) {
            return false;
        }
    }

    public function publicar($topico, $msg, $qos = 0)
    {
        try {
            $this->mqtt->publish($topico, $msg, $qos);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function ouvirDemo($topico, $qos = 0)
    {

        try {

            $this->mqtt->subscribe($topico, function ($topic, $message) {
                echo sprintf("Received message on topic [%s]: %s\n", $topic, $message);
            }, $qos);

            $this->mqtt->loop(true);

        } catch (\Exception $e) {
            return $this->desconectar();
        }

        return false;

    }

    public function ouvirTemperatura($topico, $qos = 0)
    {

        try {

            $this->mqtt->subscribe($topico, function ($topic, $message) {
                $obj = json_decode($message);

                $temperatura = new Temperatura();
                $temperatura->data = date("Y-m-d H:i:s");
                $temperatura->leitura_temperatura = $obj->valor;
                $temperatura->save();
            }, $qos);

            $this->mqtt->loop(true);

        } catch (\Exception $e) {
            return $this->desconectar();
        }

        return false;

    }

    public function setMqtt($mqtt)
    {
        $this->mqtt = $mqtt;
    }

    public function getMqtt()
    {
        return $this->mqtt;
    }

}
