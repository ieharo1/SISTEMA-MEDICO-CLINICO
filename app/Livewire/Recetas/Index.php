<?php

namespace App\Livewire\Recetas;

use Livewire\Component;
use App\Models\Receta;
use App\Models\Paciente;
use App\Models\Doctor;
use App\Models\HistorialClinico;
use Barryvdh\DomPDF\Facade\Pdf;

class Index extends Component
{
    public $recetas;
    public $pacientes;
    public $doctores;
    public $historiales;
    public $search = '';
    public $showModal = false;
    public $recetaId;
    public $historial_clinico_id, $paciente_id, $doctor_id, $fecha, $medicamentos, $dosis, $frecuencia, $duracion, $instrucciones, $observaciones;

    protected $rules = [
        'paciente_id' => 'required|exists:pacientes,id',
        'doctor_id' => 'required|exists:doctores,id',
        'historial_clinico_id' => 'nullable|exists:historiales_clinicos,id',
        'fecha' => 'required|date',
        'medicamentos' => 'required|string',
        'dosis' => 'nullable|string',
        'frecuencia' => 'nullable|string',
        'duracion' => 'nullable|string',
        'instrucciones' => 'nullable|string',
        'observaciones' => 'nullable|string',
    ];

    public function render()
    {
        $this->pacientes = Paciente::all();
        $this->doctores = Doctor::where('activo', true)->get();
        $this->historiales = HistorialClinico::with('paciente')->orderBy('fecha', 'desc')->get();

        $query = Receta::with(['paciente', 'doctor', 'historialClinico']);

        if ($this->search) {
            $query->whereHas('paciente', function($q) {
                $q->where('nombre', 'like', '%' . $this->search . '%')
                  ->orWhere('apellido', 'like', '%' . $this->search . '%');
            });
        }

        $this->recetas = $query->orderBy('fecha', 'desc')->get();

        return view('livewire.recetas.index');
    }

    public function openModal()
    {
        $this->resetFields();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetFields();
    }

    public function resetFields()
    {
        $this->recetaId = null;
        $this->historial_clinico_id = '';
        $this->paciente_id = '';
        $this->doctor_id = '';
        $this->fecha = now()->toDateString();
        $this->medicamentos = '';
        $this->dosis = '';
        $this->frecuencia = '';
        $this->duracion = '';
        $this->instrucciones = '';
        $this->observaciones = '';
    }

    public function store()
    {
        $this->validate();

        Receta::create([
            'historial_clinico_id' => $this->historial_clinico_id ?: null,
            'paciente_id' => $this->paciente_id,
            'doctor_id' => $this->doctor_id,
            'fecha' => $this->fecha,
            'medicamentos' => $this->medicamentos,
            'dosis' => $this->dosis,
            'frecuencia' => $this->frecuencia,
            'duracion' => $this->duracion,
            'instrucciones' => $this->instrucciones,
            'observaciones' => $this->observaciones,
        ]);

        $this->closeModal();
        session()->flash('message', 'Receta creada exitosamente.');
    }

    public function edit($id)
    {
        $receta = Receta::findOrFail($id);
        $this->recetaId = $receta->id;
        $this->historial_clinico_id = $receta->historial_clinico_id;
        $this->paciente_id = $receta->paciente_id;
        $this->doctor_id = $receta->doctor_id;
        $this->fecha = $receta->fecha;
        $this->medicamentos = $receta->medicamentos;
        $this->dosis = $receta->dosis;
        $this->frecuencia = $receta->frecuencia;
        $this->duracion = $receta->duracion;
        $this->instrucciones = $receta->instrucciones;
        $this->observaciones = $receta->observaciones;
        $this->showModal = true;
    }

    public function update()
    {
        $receta = Receta::findOrFail($this->recetaId);
        $receta->update([
            'historial_clinico_id' => $this->historial_clinico_id ?: null,
            'paciente_id' => $this->paciente_id,
            'doctor_id' => $this->doctor_id,
            'fecha' => $this->fecha,
            'medicamentos' => $this->medicamentos,
            'dosis' => $this->dosis,
            'frecuencia' => $this->frecuencia,
            'duracion' => $this->duracion,
            'instrucciones' => $this->instrucciones,
            'observaciones' => $this->observaciones,
        ]);

        $this->closeModal();
        session()->flash('message', 'Receta actualizada exitosamente.');
    }

    public function delete($id)
    {
        Receta::findOrFail($id)->delete();
        session()->flash('message', 'Receta eliminada exitosamente.');
    }

    public function generarPdf($id)
    {
        $receta = Receta::with(['paciente', 'doctor'])->findOrFail($id);
        
        $pdf = Pdf::loadView('recetas.pdf', compact('receta'));
        return $pdf->download('receta_' . $receta->id . '.pdf');
    }
}
