@extends('layouts.app')

@section('title', 'Exámenes - Sistema Médico')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-clipboard-pulse"></i> Exámenes</h2>
    <button class="btn btn-primary" wire:click="openModal">
        <i class="bi bi-plus-circle"></i> Nuevo Examen
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
        <input type="text" class="form-control" placeholder="Buscar exámenes..." wire:model="search">
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Tipo</th>
                        <th>Paciente</th>
                        <th>Doctor</th>
                        <th>Fecha Solicitud</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($examenes as $examen)
                    <tr>
                        <td>{{ $examen->tipo }}</td>
                        <td>{{ $examen->paciente->nombre }} {{ $examen->paciente->apellido }}</td>
                        <td>{{ $examen->doctor->user->name }}</td>
                        <td>{{ $examen->fecha_solicitud }}</td>
                        <td>
                            <span class="badge bg-{{ $examen->estado == 'Completado' ? 'success' : ($examen->estado == 'Cancelado' ? 'danger' : 'warning') }}">
                                {{ $examen->estado }}
                            </span>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-warning" wire:click="edit({{ $examen->id }})">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" wire:click="delete({{ $examen->id }})" onclick="return confirm('¿Está seguro?')">
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
                <h5 class="modal-title">{{ $examenId ? 'Editar' : 'Nuevo' }} Examen</h5>
                <button type="button" class="btn-close btn-close-white" wire:click="closeModal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Paciente</label>
                            <select class="form-select" wire:model="paciente_id">
                                <option value="">Seleccionar</option>
                                @foreach($pacientes as $p)
                                <option value="{{ $p->id }}">{{ $p->nombre }} {{ $p->apellido }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Doctor</label>
                            <select class="form-select" wire:model="doctor_id">
                                <option value="">Seleccionar</option>
                                @foreach($doctores as $d)
                                <option value="{{ $d->id }}">{{ $d->user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Tipo de Examen</label>
                        <input type="text" class="form-control" wire:model="tipo" placeholder="Ej: Biometría hemática">
                    </div>
                    <div class="mb-3">
                        <label>Descripción</label>
                        <textarea class="form-control" wire:model="descripcion" rows="2"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Fecha Solicitud</label>
                            <input type="date" class="form-control" wire:model="fecha_solicitud">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Fecha Resultado</label>
                            <input type="date" class="form-control" wire:model="fecha_resultado">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Estado</label>
                        <select class="form-select" wire:model="estado">
                            <option value="Solicitado">Solicitado</option>
                            <option value="En Proceso">En Proceso</option>
                            <option value="Completado">Completado</option>
                            <option value="Cancelado">Cancelado</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Resultados</label>
                        <textarea class="form-control" wire:model="resultados" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Observaciones</label>
                        <textarea class="form-control" wire:model="observaciones" rows="2"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" wire:click="closeModal">Cancelar</button>
                <button type="button" class="btn btn-primary" wire:click="{{ $examenId ? 'update' : 'store' }}">
                    {{ $examenId ? 'Actualizar' : 'Guardar' }}
                </button>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
