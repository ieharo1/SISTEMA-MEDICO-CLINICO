<?php

namespace App\Livewire\Citas;

use Livewire\Component;
use App\Models\Cita;
use App\Models\Paciente;
use App\Models\Doctor;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class Index extends Component
{
    public $citas;
    public $pacientes;
    public $doctores;
    public $search = '';
    public $showModal = false;
    public $citaId;
    public $paciente_id, $doctor_id, $fecha, $hora, $estado = 'Pendiente', $motivo, $observaciones;
    public $filtroFecha = '';

    protected $rules = [
        'paciente_id' => 'required|exists:pacientes,id',
        'doctor_id' => 'required|exists:doctores,id',
        'fecha' => 'required|date',
        'hora' => 'required',
        'estado' => 'required|in:Pendiente,Confirmada,En Consulta,Completada,Cancelada',
        'motivo' => 'nullable|string',
        'observaciones' => 'nullable|string',
    ];

    public function render()
    {
        $this->pacientes = Paciente::where('activo', true)->get();
        $this->doctores = Doctor::where('activo', true)->get();

        $query = Cita::with(['paciente', 'doctor']);

        if ($this->filtroFecha) {
            $query->where('fecha', $this->filtroFecha);
        }

        if ($this->search) {
            $query->whereHas('paciente', function($q) {
                $q->where('nombre', 'like', '%' . $this->search . '%')
                  ->orWhere('apellido', 'like', '%' . $this->search . '%');
            });
        }

        $this->citas = $query->orderBy('fecha', 'desc')->orderBy('hora', 'desc')->get();

        return view('livewire.citas.index');
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
        $this->citaId = null;
        $this->paciente_id = '';
        $this->doctor_id = '';
        $this->fecha = '';
        $this->hora = '';
        $this->estado = 'Pendiente';
        $this->motivo = '';
        $this->observaciones = '';
    }

    public function store()
    {
        $this->validate();

        Cita::create([
            'paciente_id' => $this->paciente_id,
            'doctor_id' => $this->doctor_id,
            'fecha' => $this->fecha,
            'hora' => $this->hora,
            'estado' => $this->estado,
            'motivo' => $this->motivo,
            'observaciones' => $this->observaciones,
        ]);

        $this->closeModal();
        session()->flash('message', 'Cita creada exitosamente.');
    }

    public function edit($id)
    {
        $cita = Cita::findOrFail($id);
        $this->citaId = $cita->id;
        $this->paciente_id = $cita->paciente_id;
        $this->doctor_id = $cita->doctor_id;
        $this->fecha = $cita->fecha;
        $this->hora = $cita->hora;
        $this->estado = $cita->estado;
        $this->motivo = $cita->motivo;
        $this->observaciones = $cita->observaciones;
        $this->showModal = true;
    }

    public function update()
    {
        $cita = Cita::findOrFail($this->citaId);
        $cita->update([
            'paciente_id' => $this->paciente_id,
            'doctor_id' => $this->doctor_id,
            'fecha' => $this->fecha,
            'hora' => $this->hora,
            'estado' => $this->estado,
            'motivo' => $this->motivo,
            'observaciones' => $this->observaciones,
        ]);

        $this->closeModal();
        session()->flash('message', 'Cita actualizada exitosamente.');
    }

    public function delete($id)
    {
        Cita::findOrFail($id)->delete();
        session()->flash('message', 'Cita eliminada exitosamente.');
    }

    public function actualizarEstado($id, $estado)
    {
        $cita = Cita::findOrFail($id);
        $cita->update(['estado' => $estado]);
        session()->flash('message', 'Estado de cita actualizado.');
    }
}
