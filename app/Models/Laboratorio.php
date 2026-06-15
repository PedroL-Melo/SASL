<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laboratorio extends Model
{
    protected $table = 'laboratorios';
    protected $fillable = [
        'nome',
        'capacidade',
        'bloco',
        'piso',
        'status_laboratorio',
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
