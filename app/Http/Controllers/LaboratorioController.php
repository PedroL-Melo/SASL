<?php

namespace App\Http\Controllers;

use App\Models\Laboratorio;
use Illuminate\Http\Request;

class LaboratorioController extends Controller
{
    public function index()
    {
        $laboratorios = Laboratorio::all();
        return view('laboratorios.index', compact('laboratorios'));
    }

    public function create()
    {
        return view('laboratorios.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'capacidade' => 'required|integer|min:1',
            'bloco' => 'required|string|max:255',
            'piso' => 'required|string|max:255',
            'status_laboratorio' => 'required|string|in:disponivel,manutencao,inativo',
        ]);

        Laboratorio::create($validated);

        return redirect()->route('laboratorios.index')->with('success', 'Laboratório criado com sucesso.');
    }

    public function show(Laboratorio $laboratorio)
    {
        return view('laboratorios.show', compact('laboratorio'));
    }

    public function edit(Laboratorio $laboratorio)
    {
        return view('laboratorios.edit', compact('laboratorio'));
    }

    public function update(Request $request, Laboratorio $laboratorio)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'capacidade' => 'required|integer|min:1',
            'bloco' => 'required|string|max:255',
            'piso' => 'required|string|max:255',
            'status_laboratorio' => 'required|string|in:disponivel,manutencao,inativo',
        ]);

        $laboratorio->update($validated);

        return redirect()->route('laboratorios.index')->with('success', 'Laboratório atualizado com sucesso.');
    }

    public function destroy(Laboratorio $laboratorio)
    {
        $laboratorio->delete();

        return redirect()->route('laboratorios.index')->with('success', 'Laboratório removido com sucesso.');
    }
}
