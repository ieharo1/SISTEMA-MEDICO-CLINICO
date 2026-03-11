<?php

namespace Database\Seeders;

use App\Models\Cita;
use App\Models\Doctor;
use App\Models\Paciente;
use Illuminate\Database\Seeder;

class CitaSeeder extends Seeder
{
    public function run(): void
    {
        $pacientes = Paciente::all();
        $doctores = Doctor::all();
        $estados = ['Pendiente', 'Confirmada', 'En Consulta', 'Completada', 'Cancelada'];
        
        $citas = [
            ['paciente_id' => 1, 'doctor_id' => 1, 'fecha' => now()->toDateString(), 'hora' => '09:00:00', 'estado' => 'Completada', 'motivo' => 'Chequeo general'],
            ['paciente_id' => 2, 'doctor_id' => 2, 'fecha' => now()->toDateString(), 'hora' => '10:00:00', 'estado' => 'En Consulta', 'motivo' => 'Dolor en el pecho'],
            ['paciente_id' => 3, 'doctor_id' => 3, 'fecha' => now()->toDateString(), 'hora' => '11:00:00', 'estado' => 'Confirmada', 'motivo' => 'Vacunación'],
            ['paciente_id' => 4, 'doctor_id' => 1, 'fecha' => now()->addDay()->toDateString(), 'hora' => '09:00:00', 'estado' => 'Pendiente', 'motivo' => 'Seguimiento diabetes'],
            ['paciente_id' => 5, 'doctor_id' => 2, 'fecha' => now()->addDays(2)->toDateString(), 'hora' => '14:00:00', 'estado' => 'Pendiente', 'motivo' => 'Chequeo cardíaco'],
        ];

        foreach ($citas as $cita) {
            Cita::create($cita);
        }
    }
}
