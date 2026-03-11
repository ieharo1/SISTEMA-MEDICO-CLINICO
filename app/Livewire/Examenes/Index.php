<?php

namespace App\Livewire\Examenes;

use Livewire\Component;
use App\Models\Examen;
use App\Models\Paciente;
use App\Models\Doctor;
use App\Models\HistorialClinico;

class Index extends Component
{
    public $examenes;
    public $pacientes;
    public $doctores;
    public $historiales;
    public $search = '';
    public $showModal = false;
    public $examenId;
    public $paciente_id, $doctor_id, $historial_clinico_id, $tipo, $descripcion, $fecha_solicitud, $fecha_resultado, $resultados, $observaciones, $estado = 'Solicitado';

    protected $rules = [
        'paciente_id' => 'required|exists:pacientes,id',
        'doctor_id' => 'required|exists:doctores,id',
        'historial_clinico_id' => 'nullable|exists:historiales_clinicos,id',
        'tipo' => 'required|string|max:255',
        'descripcion' => 'nullable|string',
        'fecha_solicitud' => 'required|date',
        'fecha_resultado' => 'nullable|date',
        'resultados' => 'nullable|string',
        'observaciones' => 'nullable|string',
        'estado' => 'required|in:Solicitado,En Proceso,Completado,Cancelado',
    ];

    public function render()
    {
        $this->pacientes = Paciente::all();
        $this->doctores = Doctor::where('activo', true)->get();
        $this->historiales = HistorialClinico::with('paciente')->orderBy('fecha', 'desc')->get();

        $query = Examen::with(['paciente', 'doctor']);

        if ($this->search) {
            $query->whereHas('paciente', function($q) {
                $q->where('nombre', 'like', '%' . $this->search . '%')
                  ->orWhere('apellido', 'like', '%' . $this->search . '%');
            })->orWhere('tipo', 'like', '%' . $this->search . '%');
        }

        $this->examenes = $query->orderBy('fecha_solicitud', 'desc')->get();

        return view('livewire.examenes.index');
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
        $this->examenId = null;
        $this->paciente_id = '';
        $this->doctor_id = '';
        $this->historial_clinico_id = '';
        $this->tipo = '';
        $this->descripcion = '';
        $this->fecha_solicitud = now()->toDateString();
        $this->fecha_resultado = '';
        $this->resultados = '';
        $this->observaciones = '';
        $this->estado = 'Solicitado';
    }

    public function store()
    {
        $this->validate();

        Examen::create([
            'paciente_id' => $this->paciente_id,
            'doctor_id' => $this->doctor_id,
            'historial_clinico_id' => $this->historial_clinico_id ?: null,
            'tipo' => $this->tipo,
            'descripcion' => $this->descripcion,
            'fecha_solicitud' => $this->fecha_solicitud,
            'fecha_resultado' => $this->fecha_resultado ?: null,
            'resultados' => $this->resultados,
            'observaciones' => $this->observaciones,
            'estado' => $this->estado,
        ]);

        $this->closeModal();
        session()->flash('message', 'Examen creado exitosamente.');
    }

    public function edit($id)
    {
        $examen = Examen::findOrFail($id);
        $this->examenId = $examen->id;
        $this->paciente_id = $examen->paciente_id;
        $this->doctor_id = $examen->doctor_id;
        $this->historial_clinico_id = $examen->historial_clinico_id;
        $this->tipo = $examen->tipo;
        $this->descripcion = $examen->descripcion;
        $this->fecha_solicitud = $examen->fecha_solicitud;
        $this->fecha_resultado = $examen->fecha_resultado;
        $this->resultados = $examen->resultados;
        $this->observaciones = $examen->observaciones;
        $this->estado = $examen->estado;
        $this->showModal = true;
    }

    public function update()
    {
        $examen = Examen::findOrFail($this->examenId);
        $examen->update([
            'paciente_id' => $this->paciente_id,
            'doctor_id' => $this->doctor_id,
            'historial_clinico_id' => $this->historial_clinico_id ?: null,
            'tipo' => $this->tipo,
            'descripcion' => $this->descripcion,
            'fecha_solicitud' => $this->fecha_solicitud,
            'fecha_resultado' => $this->fecha_resultado ?: null,
            'resultados' => $this->resultados,
            'observaciones' => $this->observaciones,
            'estado' => $this->estado,
        ]);

        $this->closeModal();
        session()->flash('message', 'Examen actualizado exitosamente.');
    }

    public function delete($id)
    {
        Examen::findOrFail($id)->delete();
        session()->flash('message', 'Examen eliminado exitosamente.');
    }

    public function actualizarEstado($id, $estado)
    {
        $examen = Examen::findOrFail($id);
        $examen->update(['estado' => $estado]);
        session()->flash('message', 'Estado de examen actualizado.');
    }
}
