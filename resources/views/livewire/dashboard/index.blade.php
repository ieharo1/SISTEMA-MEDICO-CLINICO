@extends('layouts.app')

@section('title', 'Dashboard - Sistema Médico')

@section('content')
<div class="row">
    <div class="col-12">
        <h2 class="mb-4"><i class="bi bi-speedometer2"></i> Dashboard</h2>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-3">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Pacientes</h6>
                        <h2 class="mb-0">{{ $pacientesCount }}</h2>
                    </div>
                    <i class="bi bi-people fs-1 opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Doctores</h6>
                        <h2 class="mb-0">{{ $doctoresCount }}</h2>
                    </div>
                    <i class="bi bi-person-badge fs-1 opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-warning text-dark">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Citas Hoy</h6>
                        <h2 class="mb-0">{{ $citasHoy }}</h2>
                    </div>
                    <i class="bi bi-calendar-check fs-1 opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-info text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Pendientes</h6>
                        <h2 class="mb-0">{{ $citasPendientes }}</h2>
                    </div>
                    <i class="bi bi-clock fs-1 opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-graph-up"></i> Diagnósticos Frecuentes</h5>
            </div>
            <div class="card-body">
                @if($diagnosticosFrecuentes->count() > 0)
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Diagnóstico</th>
                                <th class="text-end">Cantidad</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($diagnosticosFrecuentes as $diagnostico)
                            <tr>
                                <td>{{ $diagnostico->diagnostico }}</td>
                                <td class="text-end"><span class="badge bg-primary">{{ $diagnostico->total }}</span></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-muted">No hay diagnósticos registrados</p>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0"><i class="bi bi-info-circle"></i> Información del Sistema</h5>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Total Pacientes
                        <span class="badge bg-primary rounded-pill">{{ $pacientesCount }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Total Doctores
                        <span class="badge bg-success rounded-pill">{{ $doctoresCount }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Citas Hoy
                        <span class="badge bg-warning rounded-pill">{{ $citasHoy }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Citas Pendientes
                        <span class="badge bg-info rounded-pill">{{ $citasPendientes }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
