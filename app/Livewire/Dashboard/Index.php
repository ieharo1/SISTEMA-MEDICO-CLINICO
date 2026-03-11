<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Paciente;
use App\Models\Doctor;
use App\Models\Cita;
use App\Models\HistorialClinico;
use Illuminate\Support\Facades\DB;

class Index extends Component
{
    public $pacientesCount;
    public $doctoresCount;
    public $citasHoy;
    public $citasPendientes;
    public $diagnosticosFrecuentes;

    public function mount()
    {
        $this->pacientesCount = Paciente::count();
        $this->doctoresCount = Doctor::count();
        $this->citasHoy = Cita::where('fecha', today())->count();
        $this->citasPendientes = Cita::where('estado', 'Pendiente')->count();
        
        $this->diagnosticosFrecuentes = HistorialClinico::select('diagnostico', DB::raw('count(*) as total'))
            ->whereNotNull('diagnostico')
            ->groupBy('diagnostico')
            ->orderByDesc('total')
            ->limit(5)
            ->get();
    }

    public function render()
    {
        return view('livewire.dashboard.index');
    }
}
