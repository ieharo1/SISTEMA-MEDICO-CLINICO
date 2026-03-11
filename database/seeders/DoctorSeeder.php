<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Especialidad;
use App\Models\User;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where('email', '!=', 'admin@medical.com')->get();
        $especialidades = Especialidad::all();

        $doctores = [
            ['user_id' => $users[0]->id, 'especialidad_id' => 1, 'cedula' => '12345678', 'telefono' => '0991234567', 'direccion' => 'Av. Principal 123'],
            ['user_id' => $users[1]->id, 'especialidad_id' => 2, 'cedula' => '23456789', 'telefono' => '0992345678', 'direccion' => 'Av. Central 456'],
            ['user_id' => $users[2]->id, 'especialidad_id' => 3, 'cedula' => '34567890', 'telefono' => '0993456789', 'direccion' => 'Av. Norte 789'],
        ];

        foreach ($doctores as $doctor) {
            Doctor::create($doctor);
        }
    }
}
