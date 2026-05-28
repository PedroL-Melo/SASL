<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model
{
    protected $fillable = [
        'user_id',
        'sala_id',
        'laboratorio_id',
        'data_hora_inicio',
        'data_hora_fim',
        'status_agendamento',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sala()
    {
        return $this->belongsTo(Sala::class);
    }

    public function laboratorio()
    {
        return $this->belongsTo(Laboratorio::class);
    }
}
