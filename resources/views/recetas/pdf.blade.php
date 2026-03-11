<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Receta Médica</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #007bff; padding-bottom: 20px; }
        .title { font-size: 24px; font-weight: bold; color: #007bff; }
        .info { margin-bottom: 20px; }
        .info p { margin: 5px 0; }
        .medicamentos { background: #f8f9fa; padding: 15px; border-radius: 5px; margin-bottom: 20px; }
        .firma { margin-top: 50px; text-align: right; }
        .firma-line { border-top: 1px solid #000; width: 200px; margin-top: 50px; margin-left: auto; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">RECETA MÉDICA</div>
        <p>Sistema Médico Clínico</p>
    </div>

    <div class="info">
        <p><strong>Paciente:</strong> {{ $receta->paciente->nombre }} {{ $receta->paciente->apellido }}</p>
        <p><strong>Cédula:</strong> {{ $receta->paciente->cedula }}</p>
        <p><strong>Fecha:</strong> {{ $receta->fecha }}</p>
        <p><strong>Doctor:</strong> {{ $receta->doctor->user->name }}</p>
    </div>

    <div class="medicamentos">
        <h4>Medicamentos:</h4>
        <p>{!! nl2br(e($receta->medicamentos)) !!}</p>
        
        @if($receta->dosis)
        <p><strong>Dosis:</strong> {{ $receta->dosis }}</p>
        @endif
        
        @if($receta->frecuencia)
        <p><strong>Frecuencia:</strong> {{ $receta->frecuencia }}</p>
        @endif
        
        @if($receta->duracion)
        <p><strong>Duración:</strong> {{ $receta->duracion }}</p>
        @endif
    </div>

    @if($receta->instrucciones)
    <div class="mb-3">
        <h4>Instrucciones:</h4>
        <p>{!! nl2br(e($receta->instrucciones)) !!}</p>
    </div>
    @endif

    @if($receta->observaciones)
    <div class="mb-3">
        <h4>Observaciones:</h4>
        <p>{!! nl2br(e($receta->observaciones)) !!}</p>
    </div>
    @endif

    <div class="firma">
        <p>Firma del Médico</p>
        <div class="firma-line"></div>
    </div>
</body>
</html>
