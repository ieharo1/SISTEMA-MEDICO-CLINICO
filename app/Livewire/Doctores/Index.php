<?php

namespace App\Livewire\Doctores;

use Livewire\Component;
use App\Models\Doctor;
use App\Models\Especialidad;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class Index extends Component
{
    public $doctores;
    public $especialidades;
    public $users;
    public $search = '';
    public $showModal = false;
    public $doctorId;
    public $user_id, $especialidad_id, $cedula, $telefono, $direccion, $hora_inicio, $hora_fin, $activo = true;

    protected $rules = [
        'user_id' => 'required|exists:users,id',
        'especialidad_id' => 'required|exists:especialidades,id',
        'cedula' => 'required|string|unique:doctores,cedula',
        'telefono' => 'required|string|max:20',
        'direccion' => 'nullable|string',
        'hora_inicio' => 'required',
        'hora_fin' => 'required',
        'activo' => 'boolean',
    ];

    public function render()
    {
        $this->especialidades = Especialidad::all();
        $this->users = User::whereDoesntHave('doctor')->orWhereHas('doctor', function($q) {
            $q->where('id', $this->doctorId);
        })->get();

        $this->doctores = Doctor::with(['user', 'especialidad'])
            ->whereHas('user', function($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
            })
            ->orWhere('cedula', 'like', '%' . $this->search . '%')
            ->get();

        return view('livewire.doctores.index');
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
        $this->doctorId = null;
        $this->user_id = '';
        $this->especialidad_id = '';
        $this->cedula = '';
        $this->telefono = '';
        $this->direccion = '';
        $this->hora_inicio = '08:00';
        $this->hora_fin = '18:00';
        $this->activo = true;
    }

    public function store()
    {
        $this->validate();

        Doctor::create([
            'user_id' => $this->user_id,
            'especialidad_id' => $this->especialidad_id,
            'cedula' => $this->cedula,
            'telefono' => $this->telefono,
            'direccion' => $this->direccion,
            'hora_inicio' => $this->hora_inicio,
            'hora_fin' => $this->hora_fin,
            'activo' => $this->activo,
        ]);

        $this->closeModal();
        session()->flash('message', 'Doctor creado exitosamente.');
    }

    public function edit($id)
    {
        $doctor = Doctor::findOrFail($id);
        $this->doctorId = $doctor->id;
        $this->user_id = $doctor->user_id;
        $this->especialidad_id = $doctor->especialidad_id;
        $this->cedula = $doctor->cedula;
        $this->telefono = $doctor->telefono;
        $this->direccion = $doctor->direccion;
        $this->hora_inicio = $doctor->hora_inicio;
        $this->hora_fin = $doctor->hora_fin;
        $this->activo = $doctor->activo;
        $this->showModal = true;
    }

    public function update()
    {
        $this->validate([
            'cedula' => ['required', Rule::unique('doctores', 'cedula')->ignore($this->doctorId)],
        ]);

        $doctor = Doctor::findOrFail($this->doctorId);
        $doctor->update([
            'user_id' => $this->user_id,
            'especialidad_id' => $this->especialidad_id,
            'cedula' => $this->cedula,
            'telefono' => $this->telefono,
            'direccion' => $this->direccion,
            'hora_inicio' => $this->hora_inicio,
            'hora_fin' => $this->hora_fin,
            'activo' => $this->activo,
        ]);

        $this->closeModal();
        session()->flash('message', 'Doctor actualizado exitosamente.');
    }

    public function delete($id)
    {
        Doctor::findOrFail($id)->delete();
        session()->flash('message', 'Doctor eliminado exitosamente.');
    }
}
