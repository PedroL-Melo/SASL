<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use App\Models\Sala;
use App\Models\Laboratorio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgendamentoController extends Controller
{
    public function index()
    {
        // Auto-concluir reservas passadas que estavam aprovadas
        Agendamento::where('status_agendamento', 'aprovado')
            ->where('data_hora_fim', '<', now())
            ->update(['status_agendamento' => 'concluida']);

        $agendamentos = Agendamento::with(['user', 'sala', 'laboratorio'])->orderBy('data_hora_inicio', 'desc')->get();
        return view('agendamentos.index', compact('agendamentos'));
    }

    public function create()
    {
        $salas = Sala::where('status_sala', 'disponivel')->get();
        $laboratorios = Laboratorio::where('status_laboratorio', 'disponivel')->get();
        return view('agendamentos.create', compact('salas', 'laboratorios'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sala_id' => 'nullable|exists:salas,id',
            'laboratorio_id' => 'nullable|exists:laboratorios,id',
            'data_hora_inicio' => 'required|date',
            'data_hora_fim' => 'required|date|after:data_hora_inicio',
        ]);

        if (empty($validated['sala_id']) && empty($validated['laboratorio_id'])) {
            return back()->withErrors(['error' => 'Selecione uma sala ou um laboratório.'])->withInput();
        }

        $validated['user_id'] = Auth::id();

        // Checar conflitos de horário com agendamentos já aprovados
        $overlapQuery = Agendamento::where('status_agendamento', 'aprovado')
            ->where(function ($query) use ($validated) {
                $query->where('data_hora_inicio', '<', $validated['data_hora_fim'])
                      ->where('data_hora_fim', '>', $validated['data_hora_inicio']);
            });

        if (!empty($validated['sala_id'])) {
            $overlapQuery->where('sala_id', $validated['sala_id']);
        } else {
            $overlapQuery->where('laboratorio_id', $validated['laboratorio_id']);
        }

        $hasOverlap = $overlapQuery->exists();

        // Aplica as regras de negócio
        if ($hasOverlap) {
            $validated['status_agendamento'] = 'rejeitado';
            $message = 'Agendamento registrado como REJEITADO automaticamente devido a choque de horário com uma reserva aprovada.';
        } else {
            if (Auth::user()->status_usuario === 'professor') {
                $validated['status_agendamento'] = 'aprovado';
                $message = 'Agendamento APROVADO com sucesso.';
            } else {
                $validated['status_agendamento'] = 'pendente';
                $message = 'Agendamento solicitado e está PENDENTE de aprovação do professor.';
            }
        }

        Agendamento::create($validated);

        return redirect()->route('agendamentos.index')->with('success', $message);
    }

    public function show(Agendamento $agendamento)
    {
        $agendamento->load(['user', 'sala', 'laboratorio']);
        return view('agendamentos.show', compact('agendamento'));
    }

    public function edit(Agendamento $agendamento)
    {
        $salas = Sala::where('status_sala', 'disponivel')->get();
        $laboratorios = Laboratorio::where('status_laboratorio', 'disponivel')->get();
        return view('agendamentos.edit', compact('agendamento', 'salas', 'laboratorios'));
    }

    public function update(Request $request, Agendamento $agendamento)
    {
        $validated = $request->validate([
            'sala_id' => 'nullable|exists:salas,id',
            'laboratorio_id' => 'nullable|exists:laboratorios,id',
            'data_hora_inicio' => 'required|date',
            'data_hora_fim' => 'required|date|after:data_hora_inicio',
            'status_agendamento' => 'required|string|in:pendente,aprovado,rejeitado,cancelado,concluida',
        ]);

        if (empty($validated['sala_id']) && empty($validated['laboratorio_id'])) {
            return back()->withErrors(['error' => 'Selecione uma sala ou um laboratório.'])->withInput();
        }

        // Se estiver tentando aprovar, verificar conflito com outro aprovado (ignorando este mesmo id)
        if ($validated['status_agendamento'] === 'aprovado') {
            $overlapQuery = Agendamento::where('status_agendamento', 'aprovado')
                ->where('id', '!=', $agendamento->id)
                ->where(function ($query) use ($validated) {
                    $query->where('data_hora_inicio', '<', $validated['data_hora_fim'])
                          ->where('data_hora_fim', '>', $validated['data_hora_inicio']);
                });

            if (!empty($validated['sala_id'])) {
                $overlapQuery->where('sala_id', $validated['sala_id']);
            } else {
                $overlapQuery->where('laboratorio_id', $validated['laboratorio_id']);
            }

            if ($overlapQuery->exists()) {
                return back()->withErrors(['error' => 'Não é possível aprovar este agendamento pois há choque de horário com outra reserva já aprovada.'])->withInput();
            }
        }

        $agendamento->update($validated);

        return redirect()->route('agendamentos.index')->with('success', 'Agendamento atualizado com sucesso.');
    }

    public function destroy(Agendamento $agendamento)
    {
        $agendamento->update(['status_agendamento' => 'cancelado']);

        return redirect()->route('agendamentos.index')->with('success', 'Agendamento cancelado com sucesso.');
    }
}
