@extends('layouts.app')

@section('title', 'Recetas - Sistema Médico')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-file-earmark-prescription"></i> Recetas Médicas</h2>
    <button class="btn btn-primary" wire:click="openModal">
        <i class="bi bi-plus-circle"></i> Nueva Receta
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
        <input type="text" class="form-control" placeholder="Buscar recetas..." wire:model="search">
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
                        <th>Medicamentos</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recetas as $receta)
                    <tr>
                        <td>{{ $receta->fecha }}</td>
                        <td>{{ $receta->paciente->nombre }} {{ $receta->paciente->apellido }}</td>
                        <td>{{ $receta->doctor->user->name }}</td>
                        <td>{{ Str::limit($receta->medicamentos, 50) }}</td>
                        <td>
                            <a href="{{ route('recetas.pdf', $receta->id) }}" class="btn btn-sm btn-danger" target="_blank">
                                <i class="bi bi-file-earmark-pdf"></i> PDF
                            </a>
                            <button class="btn btn-sm btn-warning" wire:click="edit({{ $receta->id }})">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" wire:click="delete({{ $receta->id }})" onclick="return confirm('¿Está seguro?')">
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
                <h5 class="modal-title">{{ $recetaId ? 'Editar' : 'Nueva' }} Receta</h5>
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
                        <label>Medicamentos</label>
                        <textarea class="form-control" wire:model="medicamentos" rows="3" placeholder="Liste los medicamentos"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label>Dosis</label>
                            <input type="text" class="form-control" wire:model="dosis" placeholder="Ej: 1 comprimido">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Frecuencia</label>
                            <input type="text" class="form-control" wire:model="frecuencia" placeholder="Ej: 3 veces al día">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Duración</label>
                            <input type="text" class="form-control" wire:model="duracion" placeholder="Ej: 7 días">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Instrucciones</label>
                        <textarea class="form-control" wire:model="instrucciones" rows="2"></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Observaciones</label>
                        <textarea class="form-control" wire:model="observaciones" rows="2"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" wire:click="closeModal">Cancelar</button>
                <button type="button" class="btn btn-primary" wire:click="{{ $recetaId ? 'update' : 'store' }}">
                    {{ $recetaId ? 'Actualizar' : 'Guardar' }}
                </button>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
