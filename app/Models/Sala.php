<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    protected $fillable = [
        'nome',
        'capacidade',
        'bloco',
        'piso',
        'status_sala',
    ];
}
