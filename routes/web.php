<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecetaController;

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('/dashboard', function () {
    return view('livewire.dashboard.index');
})->name('dashboard');

Route::get('/pacientes', function () {
    return view('livewire.pacientes.index');
})->name('pacientes');

Route::get('/doctores', function () {
    return view('livewire.doctores.index');
})->name('doctores');

Route::get('/citas', function () {
    return view('livewire.citas.index');
})->name('citas');

Route::get('/especialidades', function () {
    return view('livewire.especialidades.index');
})->name('especialidades');

Route::get('/historial', function () {
    return view('livewire.historial.index');
})->name('historial');

Route::get('/recetas', function () {
    return view('livewire.recetas.index');
})->name('recetas');

Route::get('/examenes', function () {
    return view('livewire.examenes.index');
})->name('examenes');

Route::get('/recetas/pdf/{id}', [RecetaController::class, 'generarPdf'])->name('recetas.pdf');
