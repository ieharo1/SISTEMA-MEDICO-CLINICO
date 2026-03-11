<?php

namespace Database\Seeders;

use App\Models\Paciente;
use Illuminate\Database\Seeder;

class PacienteSeeder extends Seeder
{
    public function run(): void
    {
        $pacientes = [
            ['nombre' => 'Ana', 'apellido' => 'Martínez', 'cedula' => '0102030405', 'fecha_nacimiento' => '1990-05-15', 'sexo' => 'Femenino', 'telefono' => '0987654321', 'email' => 'ana@email.com', 'direccion' => 'Calle A 123', 'tipo_sangre' => 'O+', 'alergias' => 'Penicilina', 'enfermedades_cronicas' => 'Ninguna', 'contacto' => 'Pedro Martínez', 'telefono_emergencia' => '0991111111'],
            ['nombre' => 'Roberto', 'apellido' => 'Sánchez', 'cedula' => '0203040506', 'fecha_nacimiento' => '1985-08-22', 'sexo' => 'Masculino', 'telefono' => '0987654322', 'email' => 'roberto@email.com', 'direccion' => 'Calle B 456', 'tipo_sangre' => 'A+', 'alergias' => 'Ninguna', 'enfermedades_cronicas' => 'Diabetes', 'contacto' => 'María Sánchez', 'telefono_emergencia' => '0992222222'],
            ['nombre' => 'Laura', 'apellido' => 'Torres', 'cedula' => '0304050607', 'fecha_nacimiento' => '1995-03-10', 'sexo' => 'Femenino', 'telefono' => '0987654323', 'email' => 'laura@email.com', 'direccion' => 'Calle C 789', 'tipo_sangre' => 'B+', 'alergias' => 'Polen', 'enfermedades_cronicas' => 'Asma', 'contacto' => 'Carlos Torres', 'telefono_emergencia' => '0993333333'],
            ['nombre' => 'Miguel', 'apellido' => 'Hernández', 'cedula' => '0405060708', 'fecha_nacimiento' => '1978-12-01', 'sexo' => 'Masculino', 'telefono' => '0987654324', 'email' => 'miguel@email.com', 'direccion' => 'Calle D 321', 'tipo_sangre' => 'O-', 'alergias' => 'Ninguna', 'enfermedades_cronicas' => 'Hipertensión', 'contacto' => 'Elena Hernández', 'telefono_emergencia' => '0994444444'],
            ['nombre' => 'Sofía', 'apellido' => 'Ramírez', 'cedula' => '0506070809', 'fecha_nacimiento' => '2000-07-20', 'sexo' => 'Femenino', 'telefono' => '0987654325', 'email' => 'sofia@email.com', 'direccion' => 'Calle E 654', 'tipo_sangre' => 'AB+', 'alergias' => 'Lácteos', 'enfermedades_cronicas' => 'Ninguna', 'contacto' => 'Jorge Ramírez', 'telefono_emergencia' => '0995555555'],
        ];

        foreach ($pacientes as $p) {
            Paciente::create([
                'nombre' => $p['nombre'],
                'apellido' => $p['apellido'],
                'cedula' => $p['cedula'],
                'fecha_nacimiento' => $p['fecha_nacimiento'],
                'sexo' => $p['sexo'],
                'telefono' => $p['telefono'],
                'email' => $p['email'],
                'direccion' => $p['direccion'],
                'tipo_sangre' => $p['tipo_sangre'],
                'alergias' => $p['alergias'],
                'enfermedades_cronicas' => $p['enfermedades_cronicas'],
                'contacto_emergencia' => $p['contacto'],
                'telefono_emergencia' => $p['telefono_emergencia'],
            ]);
        }
    }
}
