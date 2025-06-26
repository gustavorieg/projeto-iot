<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Temperatura extends Model
{
    protected $table = "temperatura";
     public $primaryKey = ['data', 'leitura_temperatura'];
    public $incrementing = false;
    public $timestamps = false;

}
