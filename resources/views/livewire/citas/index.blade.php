@extends('layouts.app')

@section('title', 'Citas - Sistema Médico')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-calendar-check"></i> Citas Médicas</h2>
    <button class="btn btn-primary" wire:click="openModal">
        <i class="bi bi-plus-circle"></i> Nueva Cita
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
            <div class="col-md-4">
                <input type="text" class="form-control" placeholder="Buscar..." wire:model="search">
            </div>
            <div class="col-md-4">
                <input type="date" class="form-control" wire:model="filtroFecha">
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
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Paciente</th>
                        <th>Doctor</th>
                        <th>Motivo</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($citas as $cita)
                    <tr>
                        <td>{{ $cita->fecha }}</td>
                        <td>{{ $cita->hora }}</td>
                        <td>{{ $cita->paciente->nombre }} {{ $cita->paciente->apellido }}</td>
                        <td>{{ $cita->doctor->user->name }}</td>
                        <td>{{ $cita->motivo }}</td>
                        <td>
                            <span class="badge bg-{{ $cita->estado == 'Completada' ? 'success' : ($cita->estado == 'Cancelada' ? 'danger' : ($cita->estado == 'En Consulta' ? 'warning' : 'info')) }}">
                                {{ $cita->estado }}
                            </span>
                        </td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-sm btn-warning" wire:click="edit({{ $cita->id }})">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn btn-sm btn-danger" wire:click="delete({{ $cita->id }})" onclick="return confirm('¿Está seguro?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
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
                <h5 class="modal-title">{{ $citaId ? 'Editar' : 'Nueva' }} Cita</h5>
                <button type="button" class="btn-close btn-close-white" wire:click="closeModal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label>Paciente</label>
                        <select class="form-select" wire:model="paciente_id">
                            <option value="">Seleccionar</option>
                            @foreach($pacientes as $p)
                            <option value="{{ $p->id }}">{{ $p->nombre }} {{ $p->apellido }}</option>
                            @endforeach
                        </select>
                        @error('paciente_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Doctor</label>
                        <select class="form-select" wire:model="doctor_id">
                            <option value="">Seleccionar</option>
                            @foreach($doctores as $d)
                            <option value="{{ $d->id }}">{{ $d->user->name }} - {{ $d->especialidad->nombre }}</option>
                            @endforeach
                        </select>
                        @error('doctor_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Fecha</label>
                            <input type="date" class="form-control" wire:model="fecha">
                            @error('fecha') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Hora</label>
                            <input type="time" class="form-control" wire:model="hora">
                            @error('hora') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Estado</label>
                        <select class="form-select" wire:model="estado">
                            <option value="Pendiente">Pendiente</option>
                            <option value="Confirmada">Confirmada</option>
                            <option value="En Consulta">En Consulta</option>
                            <option value="Completada">Completada</option>
                            <option value="Cancelada">Cancelada</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Motivo</label>
                        <textarea class="form-control" wire:model="motivo" rows="2"></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Observaciones</label>
                        <textarea class="form-control" wire:model="observaciones" rows="2"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" wire:click="closeModal">Cancelar</button>
                <button type="button" class="btn btn-primary" wire:click="{{ $citaId ? 'update' : 'store' }}">
                    {{ $citaId ? 'Actualizar' : 'Guardar' }}
                </button>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
