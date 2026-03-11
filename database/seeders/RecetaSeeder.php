<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\HistorialClinico;
use App\Models\Paciente;
use App\Models\Receta;
use Illuminate\Database\Seeder;

class RecetaSeeder extends Seeder
{
    public function run(): void
    {
        $recetas = [
            ['historial_clinico_id' => 1, 'paciente_id' => 1, 'doctor_id' => 1, 'fecha' => now()->subDays(30), 'medicamentos' => 'Sulfato ferroso 300mg', 'dosis' => '1 comprimido', 'frecuencia' => '3 veces al día', 'duracion' => '30 días', 'instrucciones' => 'Tomar con las comidas', 'observaciones' => 'Evaluar respuesta al tratamiento'],
            ['historial_clinico_id' => 2, 'paciente_id' => 2, 'doctor_id' => 2, 'fecha' => now()->subDays(15), 'medicamentos' => 'Losartán 50mg', 'dosis' => '1 comprimido', 'frecuencia' => '1 vez al día', 'duracion' => '90 días', 'instrucciones' => 'Tomar en la mañana', 'observaciones' => 'Controlar presión arterial'],
            ['historial_clinico_id' => 3, 'paciente_id' => 3, 'doctor_id' => 3, 'fecha' => now()->subDays(7), 'medicamentos' => 'Vitamina C 500mg', 'dosis' => '1 comprimido', 'frecuencia' => '1 vez al día', 'duracion' => '30 días', 'instrucciones' => 'Tomar con el desayuno', 'observaciones' => 'Refuerzo vitamínico'],
        ];

        foreach ($recetas as $r) {
            Receta::create($r);
        }
    }
}
