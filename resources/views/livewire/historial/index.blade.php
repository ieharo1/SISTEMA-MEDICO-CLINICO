@extends('layouts.app')

@section('title', 'Historial Clínico - Sistema Médico')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-file-medical"></i> Historial Clínico</h2>
    <button class="btn btn-primary" wire:click="openModal">
        <i class="bi bi-plus-circle"></i> Nuevo Historial
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
        <input type="text" class="form-control" placeholder="Buscar por paciente..." wire:model="search">
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Paciente</th>
                        <th>Doctor</th>
                        <th>Diagnóstico</th>
                        <th>Peso</th>
                        <th>Presión</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($historiales as $h)
                    <tr>
                        <td>{{ $h->fecha }}</td>
                        <td>{{ $h->paciente->nombre }} {{ $h->paciente->apellido }}</td>
                        <td>{{ $h->doctor->user->name }}</td>
                        <td>{{ $h->diagnostico }}</td>
                        <td>{{ $h->peso }} kg</td>
                        <td>{{ $h->presion_sistolica }}/{{ $h->presion_diastolica }}</td>
                        <td>
                            <button class="btn btn-sm btn-warning" wire:click="edit({{ $h->id }})">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" wire:click="delete({{ $h->id }})" onclick="return confirm('¿Está seguro?')">
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
                <h5 class="modal-title">{{ $historialId ? 'Editar' : 'Nuevo' }} Historial</h5>
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
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label>Peso (kg)</label>
                            <input type="number" step="0.01" class="form-control" wire:model="peso">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Altura (m)</label>
                            <input type="number" step="0.01" class="form-control" wire:model="altura">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Temperatura (°C)</label>
                            <input type="number" step="0.1" class="form-control" wire:model="temperatura">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Presión Sistólica</label>
                            <input type="number" class="form-control" wire:model="presion_sistolica">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Presión Diastólica</label>
                            <input type="number" class="form-control" wire:model="presion_diastolica">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Síntomas</label>
                        <textarea class="form-control" wire:model="sintomas" rows="2"></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Diagnóstico</label>
                        <textarea class="form-control" wire:model="diagnostico" rows="2"></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Tratamiento</label>
                        <textarea class="form-control" wire:model="tratamiento" rows="2"></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Observaciones</label>
                        <textarea class="form-control" wire:model="observaciones" rows="2"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" wire:click="closeModal">Cancelar</button>
                <button type="button" class="btn btn-primary" wire:click="{{ $historialId ? 'update' : 'store' }}">
                    {{ $historialId ? 'Actualizar' : 'Guardar' }}
                </button>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
