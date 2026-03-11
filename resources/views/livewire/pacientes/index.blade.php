@extends('layouts.app')

@section('title', 'Pacientes - Sistema Médico')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-people"></i> Pacientes</h2>
    <button class="btn btn-primary" wire:click="openModal">
        <i class="bi bi-plus-circle"></i> Nuevo Paciente
    </button>
</div>

@if(session()->has('message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('message') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="card mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <input type="text" class="form-control" placeholder="Buscar pacientes..." wire:model="search">
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Cédula</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Tipo Sangre</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pacientes as $paciente)
                    <tr>
                        <td>{{ $paciente->nombre }} {{ $paciente->apellido }}</td>
                        <td>{{ $paciente->cedula }}</td>
                        <td>{{ $paciente->telefono }}</td>
                        <td>{{ $paciente->email }}</td>
                        <td>{{ $paciente->tipo_sangre }}</td>
                        <td>
                            @if($paciente->activo)
                            <span class="badge bg-success">Activo</span>
                            @else
                            <span class="badge bg-secondary">Inactivo</span>
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-sm btn-warning" wire:click="edit({{ $paciente->id }})">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" wire:click="delete({{ $paciente->id }})" onclick="return confirm('¿Está seguro?')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@if($showModal)
<div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">{{ $pacienteId ? 'Editar' : 'Nuevo' }} Paciente</h5>
                <button type="button" class="btn-close btn-close-white" wire:click="closeModal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Nombre</label>
                            <input type="text" class="form-control" wire:model="nombre">
                            @error('nombre') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Apellido</label>
                            <input type="text" class="form-control" wire:model="apellido">
                            @error('apellido') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Cédula</label>
                            <input type="text" class="form-control" wire:model="cedula">
                            @error('cedula') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Fecha Nacimiento</label>
                            <input type="date" class="form-control" wire:model="fecha_nacimiento">
                            @error('fecha_nacimiento') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Sexo</label>
                            <select class="form-select" wire:model="sexo">
                                <option value="">Seleccionar</option>
                                <option value="Masculino">Masculino</option>
                                <option value="Femenino">Femenino</option>
                            </select>
                            @error('sexo') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Teléfono</label>
                            <input type="text" class="form-control" wire:model="telefono">
                            @error('telefono') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Email</label>
                            <input type="email" class="form-control" wire:model="email">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Tipo Sangre</label>
                            <select class="form-select" wire:model="tipo_sangre">
                                <option value="">Seleccionar</option>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Dirección</label>
                        <textarea class="form-control" wire:model="direccion" rows="2"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Alergias</label>
                            <textarea class="form-control" wire:model="alergias" rows="2"></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Enfermedades Crónicas</label>
                            <textarea class="form-control" wire:model="enfermedades_cronicas" rows="2"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Contacto Emergencia</label>
                            <input type="text" class="form-control" wire:model="contacto_emergencia">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Teléfono Emergencia</label>
                            <input type="text" class="form-control" wire:model="telefono_emergencia">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" wire:click="closeModal">Cancelar</button>
                <button type="button" class="btn btn-primary" wire:click="{{ $pacienteId ? 'update' : 'store' }}">
                    {{ $pacienteId ? 'Actualizar' : 'Guardar' }}
                </button>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
