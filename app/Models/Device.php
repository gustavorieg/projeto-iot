<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{

    use HasFactory;

    public $table = 'device';
    public $primaryKey = 'codigo';
    public $incrementing = true;
    public $timestamps = false;

}
