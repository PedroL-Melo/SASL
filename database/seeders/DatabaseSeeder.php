<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Sala;
use App\Models\Laboratorio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Criação do Professor (Administrador)
        User::firstOrCreate(
            ['email' => 'professor@ifac.edu.br'],
            [
                'name' => 'Professor (Admin)',
                'password' => Hash::make('password'),
                'status_usuario' => 'professor',
            ]
        );

        // Criação do Aluno
        User::firstOrCreate(
            ['email' => 'aluno@ifac.edu.br'],
            [
                'name' => 'Aluno',
                'password' => Hash::make('password'),
                'status_usuario' => 'aluno',
            ]
        );

        // Criação de uma Sala
        Sala::firstOrCreate(
            ['nome' => 'Sala 101'],
            [
                'capacidade' => 30,
                'bloco' => 'A',
                'piso' => 1,
                'status_sala' => 'disponivel',
            ]
        );

        // Criação de um Laboratório
        Laboratorio::firstOrCreate(
            ['nome' => 'Laboratório 1'],
            [
                'capacidade' => 25,
                'bloco' => 'B',
                'piso' => 0,
                'status_laboratorio' => 'disponivel',
            ]
        );
    }
}
