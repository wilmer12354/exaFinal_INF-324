<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VistasController extends Controller
{
    public function index()
    {
        // Obtener todos los médicos
        $medicos = Medico::all();

        // Obtener todas las especialidades
        $especialidades = Especialidad::all();

        // Pasar los datos a la vista
        return view('medicoespecialidad.index', compact('medicos', 'especialidades'));
    }
}
