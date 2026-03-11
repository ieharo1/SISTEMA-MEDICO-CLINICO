<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\HistorialClinico;
use App\Models\Paciente;
use Illuminate\Database\Seeder;

class HistorialClinicoSeeder extends Seeder
{
    public function run(): void
    {
        $historiales = [
            ['paciente_id' => 1, 'doctor_id' => 1, 'fecha' => now()->subDays(30), 'peso' => 65.5, 'altura' => 1.65, 'presion_sistolica' => 120, 'presion_diastolica' => 80, 'temperatura' => 36.5, 'sintomas' => 'Fatiga moderada', 'diagnostico' => 'Anemia leve', 'tratamiento' => 'Suplementos de hierro', 'observaciones' => 'Seguimiento en 30 días'],
            ['paciente_id' => 2, 'doctor_id' => 2, 'fecha' => now()->subDays(15), 'peso' => 80.0, 'altura' => 1.75, 'presion_sistolica' => 140, 'presion_diastolica' => 90, 'temperatura' => 36.8, 'sintomas' => 'Dolor torácico', 'diagnostico' => 'Hipertensión arterial', 'tratamiento' => 'Losartán 50mg', 'observaciones' => '_control mensual'],
            ['paciente_id' => 3, 'doctor_id' => 3, 'fecha' => now()->subDays(7), 'peso' => 55.0, 'altura' => 1.60, 'presion_sistolica' => 110, 'presion_diastolica' => 70, 'temperatura' => 36.6, 'sintomas' => 'Sin síntomas', 'diagnostico' => 'Saludable', 'tratamiento' => 'Ninguno', 'observaciones' => 'Chequeo rutina'],
        ];

        foreach ($historiales as $h) {
            HistorialClinico::create($h);
        }
    }
}
