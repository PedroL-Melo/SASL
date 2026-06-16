<?php

namespace App\Http\Controllers;

use App\Models\Sala;
use Illuminate\Http\Request;

class SalaController extends Controller
{
    public function index()
    {
        $salas = Sala::all();
        return view('salas.index', compact('salas'));
    }

    public function create()
    {
        return view('salas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'capacidade' => 'required|integer|min:1',
            'bloco' => 'required|string|max:255',
            'piso' => 'required|integer|min:0',
            'status_sala' => 'required|string|in:disponivel,manutencao,inativo',
        ]);

        Sala::create($validated);

        return redirect()->route('salas.index')->with('success', 'Sala criada com sucesso.');
    }

    public function show(Sala $sala)
    {
        return view('salas.show', compact('sala'));
    }

    public function edit(Sala $sala)
    {
        return view('salas.edit', compact('sala'));
    }

    public function update(Request $request, Sala $sala)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'capacidade' => 'required|integer|min:1',
            'bloco' => 'required|string|max:255',
            'piso' => 'required|integer|min:0',
            'status_sala' => 'required|string|in:disponivel,manutencao,inativo',
        ]);

        $sala->update($validated);

        return redirect()->route('salas.index')->with('success', 'Sala atualizada com sucesso.');
    }

    public function destroy(Sala $sala)
    {
        $sala->delete();

        return redirect()->route('salas.index')->with('success', 'Sala removida com sucesso.');
    }
}
