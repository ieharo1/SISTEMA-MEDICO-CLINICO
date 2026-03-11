<?php

namespace App\Livewire\Especialidades;

use Livewire\Component;
use App\Models\Especialidad;

class Index extends Component
{
    public $especialidades;
    public $search = '';
    public $showModal = false;
    public $especialidadId;
    public $nombre, $descripcion;

    protected $rules = [
        'nombre' => 'required|string|max:255|unique:especialidades,nombre',
        'descripcion' => 'nullable|string',
    ];

    public function render()
    {
        $this->especialidades = Especialidad::where('nombre', 'like', '%' . $this->search . '%')
            ->orderBy('nombre')
            ->get();

        return view('livewire.especialidades.index');
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
        $this->especialidadId = null;
        $this->nombre = '';
        $this->descripcion = '';
    }

    public function store()
    {
        $this->validate();

        Especialidad::create([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
        ]);

        $this->closeModal();
        session()->flash('message', 'Especialidad creada exitosamente.');
    }

    public function edit($id)
    {
        $especialidad = Especialidad::findOrFail($id);
        $this->especialidadId = $especialidad->id;
        $this->nombre = $especialidad->nombre;
        $this->descripcion = $especialidad->descripcion;
        $this->showModal = true;
    }

    public function update()
    {
        $this->validate([
            'nombre' => 'required|string|max:255|unique:especialidades,nombre,' . $this->especialidadId,
        ]);

        $especialidad = Especialidad::findOrFail($this->especialidadId);
        $especialidad->update([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
        ]);

        $this->closeModal();
        session()->flash('message', 'Especialidad actualizada exitosamente.');
    }

    public function delete($id)
    {
        Especialidad::findOrFail($id)->delete();
        session()->flash('message', 'Especialidad eliminada exitosamente.');
    }
}
