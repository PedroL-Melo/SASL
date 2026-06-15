<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{   
    protected $table = 'salas';
    protected $fillable = [
        'nome',
        'capacidade',
        'bloco',
        'piso',
        'status_sala',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function agendamentos()
    {
        return $this->hasMany(Agendamento::class);
    }
}
