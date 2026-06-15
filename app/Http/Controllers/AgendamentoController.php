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
        $agendamentos = Agendamento::with(['user', 'sala', 'laboratorio'])->get();
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
            'status_agendamento' => 'required|string|in:pendente,aprovado,rejeitado,cancelado',
        ]);

        if (empty($validated['sala_id']) && empty($validated['laboratorio_id'])) {
            return back()->withErrors(['error' => 'Selecione uma sala ou um laboratório.'])->withInput();
        }

        $validated['user_id'] = Auth::id();

        Agendamento::create($validated);

        return redirect()->route('agendamentos.index')->with('success', 'Agendamento criado com sucesso.');
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
            'status_agendamento' => 'required|string|in:pendente,aprovado,rejeitado,cancelado',
        ]);

        if (empty($validated['sala_id']) && empty($validated['laboratorio_id'])) {
            return back()->withErrors(['error' => 'Selecione uma sala ou um laboratório.'])->withInput();
        }

        $agendamento->update($validated);

        return redirect()->route('agendamentos.index')->with('success', 'Agendamento atualizado com sucesso.');
    }

    public function destroy(Agendamento $agendamento)
    {
        $agendamento->delete();

        return redirect()->route('agendamentos.index')->with('success', 'Agendamento removido com sucesso.');
    }
}
