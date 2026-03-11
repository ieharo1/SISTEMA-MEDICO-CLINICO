<?php

namespace App\Http\Controllers;

use App\Models\Receta;
use Barryvdh\DomPDF\Facade\Pdf;

class RecetaController extends Controller
{
    public function generarPdf($id)
    {
        $receta = Receta::with(['paciente', 'doctor'])->findOrFail($id);
        
        $pdf = Pdf::loadView('recetas.pdf', compact('receta'));
        
        return $pdf->download('receta_' . $receta->id . '.pdf');
    }
}
