<?php

namespace App\Livewire\Pacientes;

use Livewire\Component;
use App\Models\Paciente;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class Index extends Component
{
    public $pacientes;
    public $search = '';
    public $showModal = false;
    public $pacienteId;
    public $nombre, $apellido, $cedula, $fecha_nacimiento, $sexo, $telefono, $email, $direccion, $tipo_sangre, $alergias, $enfermedades_cronicas, $contacto_emergencia, $telefono_emergencia;

    protected $rules = [
        'nombre' => 'required|string|max:255',
        'apellido' => 'required|string|max:255',
        'cedula' => 'required|string|unique:pacientes,cedula',
        'fecha_nacimiento' => 'required|date',
        'sexo' => 'required|in:Masculino,Femenino',
        'telefono' => 'required|string|max:20',
        'email' => 'nullable|email',
        'direccion' => 'nullable|string',
        'tipo_sangre' => 'nullable|string|max:5',
        'alergias' => 'nullable|string',
        'enfermedades_cronicas' => 'nullable|string',
        'contacto_emergencia' => 'nullable|string|max:255',
        'telefono_emergencia' => 'nullable|string|max:20',
    ];

    public function render()
    {
        $this->pacientes = Paciente::where('nombre', 'like', '%' . $this->search . '%')
            ->orWhere('apellido', 'like', '%' . $this->search . '%')
            ->orWhere('cedula', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.pacientes.index');
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
        $this->pacienteId = null;
        $this->nombre = '';
        $this->apellido = '';
        $this->cedula = '';
        $this->fecha_nacimiento = '';
        $this->sexo = '';
        $this->telefono = '';
        $this->email = '';
        $this->direccion = '';
        $this->tipo_sangre = '';
        $this->alergias = '';
        $this->enfermedades_cronicas = '';
        $this->contacto_emergencia = '';
        $this->telefono_emergencia = '';
    }

    public function store()
    {
        $this->validate();

        Paciente::create([
            'nombre' => $this->nombre,
            'apellido' => $this->apellido,
            'cedula' => $this->cedula,
            'fecha_nacimiento' => $this->fecha_nacimiento,
            'sexo' => $this->sexo,
            'telefono' => $this->telefono,
            'email' => $this->email,
            'direccion' => $this->direccion,
            'tipo_sangre' => $this->tipo_sangre,
            'alergias' => $this->alergias,
            'enfermedades_cronicas' => $this->enfermedades_cronicas,
            'contacto_emergencia' => $this->contacto_emergencia,
            'telefono_emergencia' => $this->telefono_emergencia,
        ]);

        $this->closeModal();
        session()->flash('message', 'Paciente creado exitosamente.');
    }

    public function edit($id)
    {
        $paciente = Paciente::findOrFail($id);
        $this->pacienteId = $paciente->id;
        $this->nombre = $paciente->nombre;
        $this->apellido = $paciente->apellido;
        $this->cedula = $paciente->cedula;
        $this->fecha_nacimiento = $paciente->fecha_nacimiento;
        $this->sexo = $paciente->sexo;
        $this->telefono = $paciente->telefono;
        $this->email = $paciente->email;
        $this->direccion = $paciente->direccion;
        $this->tipo_sangre = $paciente->tipo_sangre;
        $this->alergias = $paciente->alergias;
        $this->enfermedades_cronicas = $paciente->enfermedades_cronicas;
        $this->contacto_emergencia = $paciente->contacto_emergencia;
        $this->telefono_emergencia = $paciente->telefono_emergencia;
        $this->showModal = true;
    }

    public function update()
    {
        $this->validate([
            'cedula' => ['required', Rule::unique('pacientes', 'cedula')->ignore($this->pacienteId)],
        ]);

        $paciente = Paciente::findOrFail($this->pacienteId);
        $paciente->update([
            'nombre' => $this->nombre,
            'apellido' => $this->apellido,
            'cedula' => $this->cedula,
            'fecha_nacimiento' => $this->fecha_nacimiento,
            'sexo' => $this->sexo,
            'telefono' => $this->telefono,
            'email' => $this->email,
            'direccion' => $this->direccion,
            'tipo_sangre' => $this->tipo_sangre,
            'alergias' => $this->alergias,
            'enfermedades_cronicas' => $this->enfermedades_cronicas,
            'contacto_emergencia' => $this->contacto_emergencia,
            'telefono_emergencia' => $this->telefono_emergencia,
        ]);

        $this->closeModal();
        session()->flash('message', 'Paciente actualizado exitosamente.');
    }

    public function delete($id)
    {
        Paciente::findOrFail($id)->delete();
        session()->flash('message', 'Paciente eliminado exitosamente.');
    }
}
