<?php

namespace App\Livewire\Historial;

use Livewire\Component;
use App\Models\HistorialClinico;
use App\Models\Paciente;
use App\Models\Doctor;
use App\Models\Cita;

class Index extends Component
{
    public $historiales;
    public $pacientes;
    public $doctores;
    public $search = '';
    public $showModal = false;
    public $historialId;
    public $paciente_id, $doctor_id, $cita_id, $fecha, $peso, $altura, $presion_sistolica, $presion_diastolica, $temperatura, $sintomas, $diagnostico, $tratamiento, $observaciones;

    protected $rules = [
        'paciente_id' => 'required|exists:pacientes,id',
        'doctor_id' => 'required|exists:doctores,id',
        'cita_id' => 'nullable|exists:citas,id',
        'fecha' => 'required|date',
        'peso' => 'nullable|numeric|min:0',
        'altura' => 'nullable|numeric|min:0',
        'presion_sistolica' => 'nullable|integer|min:0',
        'presion_diastolica' => 'nullable|integer|min:0',
        'temperatura' => 'nullable|numeric|min:0',
        'sintomas' => 'nullable|string',
        'diagnostico' => 'nullable|string',
        'tratamiento' => 'nullable|string',
        'observaciones' => 'nullable|string',
    ];

    public function render()
    {
        $this->pacientes = Paciente::all();
        $this->doctores = Doctor::where('activo', true)->get();

        $query = HistorialClinico::with(['paciente', 'doctor']);

        if ($this->search) {
            $query->whereHas('paciente', function($q) {
                $q->where('nombre', 'like', '%' . $this->search . '%')
                  ->orWhere('apellido', 'like', '%' . $this->search . '%');
            });
        }

        $this->historiales = $query->orderBy('fecha', 'desc')->get();

        return view('livewire.historial.index');
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
        $this->historialId = null;
        $this->paciente_id = '';
        $this->doctor_id = '';
        $this->cita_id = '';
        $this->fecha = now()->toDateString();
        $this->peso = '';
        $this->altura = '';
        $this->presion_sistolica = '';
        $this->presion_diastolica = '';
        $this->temperatura = '';
        $this->sintomas = '';
        $this->diagnostico = '';
        $this->tratamiento = '';
        $this->observaciones = '';
    }

    public function store()
    {
        $this->validate();

        HistorialClinico::create([
            'paciente_id' => $this->paciente_id,
            'doctor_id' => $this->doctor_id,
            'cita_id' => $this->cita_id ?: null,
            'fecha' => $this->fecha,
            'peso' => $this->peso ?: null,
            'altura' => $this->altura ?: null,
            'presion_sistolica' => $this->presion_sistolica ?: null,
            'presion_diastolica' => $this->presion_diastolica ?: null,
            'temperatura' => $this->temperatura ?: null,
            'sintomas' => $this->sintomas,
            'diagnostico' => $this->diagnostico,
            'tratamiento' => $this->tratamiento,
            'observaciones' => $this->observaciones,
        ]);

        $this->closeModal();
        session()->flash('message', 'Historial clínico creado exitosamente.');
    }

    public function edit($id)
    {
        $historial = HistorialClinico::findOrFail($id);
        $this->historialId = $historial->id;
        $this->paciente_id = $historial->paciente_id;
        $this->doctor_id = $historial->doctor_id;
        $this->cita_id = $historial->cita_id;
        $this->fecha = $historial->fecha;
        $this->peso = $historial->peso;
        $this->altura = $historial->altura;
        $this->presion_sistolica = $historial->presion_sistolica;
        $this->presion_diastolica = $historial->presion_diastolica;
        $this->temperatura = $historial->temperatura;
        $this->sintomas = $historial->sintomas;
        $this->diagnostico = $historial->diagnostico;
        $this->tratamiento = $historial->tratamiento;
        $this->observaciones = $historial->observaciones;
        $this->showModal = true;
    }

    public function update()
    {
        $historial = HistorialClinico::findOrFail($this->historialId);
        $historial->update([
            'paciente_id' => $this->paciente_id,
            'doctor_id' => $this->doctor_id,
            'cita_id' => $this->cita_id ?: null,
            'fecha' => $this->fecha,
            'peso' => $this->peso ?: null,
            'altura' => $this->altura ?: null,
            'presion_sistolica' => $this->presion_sistolica ?: null,
            'presion_diastolica' => $this->presion_diastolica ?: null,
            'temperatura' => $this->temperatura ?: null,
            'sintomas' => $this->sintomas,
            'diagnostico' => $this->diagnostico,
            'tratamiento' => $this->tratamiento,
            'observaciones' => $this->observaciones,
        ]);

        $this->closeModal();
        session()->flash('message', 'Historial clínico actualizado exitosamente.');
    }

    public function delete($id)
    {
        HistorialClinico::findOrFail($id)->delete();
        session()->flash('message', 'Historial clínico eliminado exitosamente.');
    }
}
