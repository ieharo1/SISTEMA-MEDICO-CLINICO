<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Examen;
use App\Models\Paciente;
use Illuminate\Database\Seeder;

class ExamenSeeder extends Seeder
{
    public function run(): void
    {
        $examenes = [
            ['paciente_id' => 1, 'doctor_id' => 1, 'tipo' => 'Biometría hemática', 'descripcion' => 'Análisis de sangre completo', 'fecha_solicitud' => now()->subDays(30), 'fecha_resultado' => now()->subDays(28), 'resultados' => 'Hemoglobina: 11.5 g/dL, Hematocrito: 35%', 'estado' => 'Completado'],
            ['paciente_id' => 2, 'doctor_id' => 2, 'tipo' => 'Electrocardiograma', 'descripcion' => 'Estudio del ritmo cardíaco', 'fecha_solicitud' => now()->subDays(10), 'fecha_resultado' => now()->subDays(8), 'resultados' => 'Ritmo sinusal normal', 'estado' => 'Completado'],
            ['paciente_id' => 4, 'doctor_id' => 1, 'tipo' => 'Perfil lipídico', 'descripcion' => 'Análisis de grasas en sangre', 'fecha_solicitud' => now()->subDays(5), 'fecha_resultado' => now()->subDays(3), 'resultados' => 'Colesterol total: 210 mg/dL, LDL: 130 mg/dL', 'estado' => 'Completado'],
            ['paciente_id' => 3, 'doctor_id' => 3, 'tipo' => 'Vacuna', 'descripcion' => 'Vacuna triple viral', 'fecha_solicitud' => now()->toDateString(), 'estado' => 'Solicitado'],
        ];

        foreach ($examenes as $e) {
            Examen::create($e);
        }
    }
}
