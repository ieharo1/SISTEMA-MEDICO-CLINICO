@extends('layouts.app')

@section('title', 'Especialidades - Sistema Médico')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-briefcase"></i> Especialidades</h2>
    <button class="btn btn-primary" wire:click="openModal">
        <i class="bi bi-plus-circle"></i> Nueva Especialidad
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
        <input type="text" class="form-control" placeholder="Buscar especialidades..." wire:model="search">
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($especialidades as $esp)
                    <tr>
                        <td>{{ $esp->nombre }}</td>
                        <td>{{ $esp->descripcion }}</td>
                        <td>
                            <button class="btn btn-sm btn-warning" wire:click="edit({{ $esp->id }})">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" wire:click="delete({{ $esp->id }})" onclick="return confirm('¿Está seguro?')">
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
                <h5 class="modal-title">{{ $especialidadId ? 'Editar' : 'Nueva' }} Especialidad</h5>
                <button type="button" class="btn-close btn-close-white" wire:click="closeModal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>Nombre</label>
                    <input type="text" class="form-control" wire:model="nombre">
                    @error('nombre') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label>Descripción</label>
                    <textarea class="form-control" wire:model="descripcion" rows="3"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" wire:click="closeModal">Cancelar</button>
                <button type="button" class="btn btn-primary" wire:click="{{ $especialidadId ? 'update' : 'store' }}">
                    {{ $especialidadId ? 'Actualizar' : 'Guardar' }}
                </button>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
