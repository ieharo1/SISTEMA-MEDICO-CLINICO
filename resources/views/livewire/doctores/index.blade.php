@extends('layouts.app')

@section('title', 'Doctores - Sistema Médico')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-person-badge"></i> Doctores</h2>
    <button class="btn btn-primary" wire:click="openModal">
        <i class="bi bi-plus-circle"></i> Nuevo Doctor
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
                <input type="text" class="form-control" placeholder="Buscar doctores..." wire:model="search">
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
                        <th>Especialidad</th>
                        <th>Cédula</th>
                        <th>Teléfono</th>
                        <th>Horario</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($doctores as $doctor)
                    <tr>
                        <td>{{ $doctor->user->name }}</td>
                        <td>{{ $doctor->especialidad->nombre }}</td>
                        <td>{{ $doctor->cedula }}</td>
                        <td>{{ $doctor->telefono }}</td>
                        <td>{{ $doctor->hora_inicio }} - {{ $doctor->hora_fin }}</td>
                        <td>
                            @if($doctor->activo)
                            <span class="badge bg-success">Activo</span>
                            @else
                            <span class="badge bg-secondary">Inactivo</span>
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-sm btn-warning" wire:click="edit({{ $doctor->id }})">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" wire:click="delete({{ $doctor->id }})" onclick="return confirm('¿Está seguro?')">
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
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">{{ $doctorId ? 'Editar' : 'Nuevo' }} Doctor</h5>
                <button type="button" class="btn-close btn-close-white" wire:click="closeModal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label>Usuario</label>
                        <select class="form-select" wire:model="user_id">
                            <option value="">Seleccionar</option>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                        @error('user_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Especialidad</label>
                        <select class="form-select" wire:model="especialidad_id">
                            <option value="">Seleccionar</option>
                            @foreach($especialidades as $esp)
                            <option value="{{ $esp->id }}">{{ $esp->nombre }}</option>
                            @endforeach
                        </select>
                        @error('especialidad_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Cédula</label>
                        <input type="text" class="form-control" wire:model="cedula">
                        @error('cedula') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Teléfono</label>
                        <input type="text" class="form-control" wire:model="telefono">
                        @error('telefono') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Dirección</label>
                        <textarea class="form-control" wire:model="direccion" rows="2"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Hora Inicio</label>
                            <input type="time" class="form-control" wire:model="hora_inicio">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Hora Fin</label>
                            <input type="time" class="form-control" wire:model="hora_fin">
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" wire:model="activo" id="activo">
                            <label class="form-check-label" for="activo">Activo</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" wire:click="closeModal">Cancelar</button>
                <button type="button" class="btn btn-primary" wire:click="{{ $doctorId ? 'update' : 'store' }}">
                    {{ $doctorId ? 'Actualizar' : 'Guardar' }}
                </button>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
