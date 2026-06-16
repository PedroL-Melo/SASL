<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SalaController;
use App\Http\Controllers\LaboratorioController;
use App\Http\Controllers\AgendamentoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    $salas = App\Models\Sala::all();
    $laboratorios = App\Models\Laboratorio::all();
    return view('dashboard', compact('salas', 'laboratorios'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('isProfessor')->group(function () {
        Route::resource('salas', SalaController::class);
        Route::resource('laboratorios', LaboratorioController::class);
    });

    Route::resource('agendamentos', AgendamentoController::class);
});

require __DIR__.'/auth.php';


