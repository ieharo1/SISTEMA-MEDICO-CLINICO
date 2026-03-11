<?php

namespace Database\Seeders;

use App\Models\Especialidad;
use Illuminate\Database\Seeder;

class EspecialidadSeeder extends Seeder
{
    public function run(): void
    {
        $especialidades = [
            ['nombre' => 'Medicina General', 'descripcion' => 'Atención primaria y medicina preventiva'],
            ['nombre' => 'Cardiología', 'descripcion' => 'Enfermedades del corazón y sistema cardiovascular'],
            ['nombre' => 'Pediatría', 'descripcion' => 'Atención médica de niños y adolescentes'],
            ['nombre' => 'Dermatología', 'descripcion' => 'Enfermedades de la piel'],
            ['nombre' => 'Gastroenterología', 'descripcion' => 'Sistema digestivo'],
            ['nombre' => 'Neurología', 'descripcion' => 'Sistema nervioso'],
            ['nombre' => 'Oftalmología', 'descripcion' => 'Enfermedades de los ojos'],
            ['nombre' => 'Ortopedia', 'descripcion' => 'Sistema musculoesquelético'],
        ];

        foreach ($especialidades as $esp) {
            Especialidad::create($esp);
        }
    }
}
