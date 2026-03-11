<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistema Médico')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    @livewireStyles
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <i class="bi bi-hospital"></i> Sistema Médico
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/"><i class="bi bi-speedometer2"></i> Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/pacientes"><i class="bi bi-people"></i> Pacientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/doctores"><i class="bi bi-person-badge"></i> Doctores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/citas"><i class="bi bi-calendar-check"></i> Citas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/especialidades"><i class="bi bi-briefcase"></i> Especialidades</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/historial"><i class="bi bi-file-medical"></i> Historial</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/recetas"><i class="bi bi-file-earmark-prescription"></i> Recetas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/examenes"><i class="bi bi-clipboard-pulse"></i> Exámenes</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <span class="navbar-text text-white">
                        <i class="bi bi-person-circle"></i> {{ auth()->user()->name ?? 'Admin' }}
                    </span>
                </div>
            </div>
        </div>
    </nav>

    <main class="container-fluid py-4">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @livewireScripts
</body>
</html>
