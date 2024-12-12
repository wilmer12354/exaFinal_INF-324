<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConsultaController extends Controller
{
    public function index()
    {
        $datos = DB::select("select * from consultas");
        $especiliadaes = DB::select("select * from especialidades");
        $medicos = DB::select("select * from medicos");
        $pacientes = DB::select("select * from pacientes");

        // Pasar todos los datos a la vista
        return view("welcome2")
            ->with("datos", $datos)
            ->with("medicos", $medicos)
            ->with("pacientes", $pacientes)
            ->with("especialidades", $especiliadaes);
    }


    public function create(Request $request)
    {

        try {

            $sql = DB::insert("insert into consultas(id, paciente_id, medico_id, fecha, diagnostico) values(?,?,?,?,?)", [
                $request->txtid,
                $request->txtidpaciente,
                $request->txtidmedico,
                $request->txtfecha,
                $request->txtdiagnostico
            ]);
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == true) {
            return back()->with("correcto", "Consulta registrado correctamente");
        } else {
            return back()->with("incorrecto", "Error al registrar");
        }
    }

    public function update(Request $request)
    {
        try {
            // Realizar la actualización con una sentencia SQL directa
            $sql = DB::update("UPDATE consultas SET paciente_id=?, medico_id=?, fecha=?, diagnostico=? WHERE id=?", [
                $request->input('txtidpaciente'),
                $request->input('txtidmedico'),
                $request->input('txtfecha'),
                $request->input('txtdiagnostico'),
                $request->input('txtid')
            ]);

            if ($sql == 0) {
                return back()->with("sin_modificar", "No se modificó ningún dato...");
            }

        } catch (\Throwable $th) {
            return back()->with("incorrecto", "Error al modificar: " . $th->getMessage());
        }
        return back()->with("correcto", "Consulta modificada correctamente");
    }


    public function delete($id)
    {
        try {
            $sqlConsultas = DB::delete("DELETE FROM consultas WHERE id = ?", [$id]);
            

        } catch (\Throwable $th) {
            return back()->with("incorrecto", "Error al eliminar: " . $th->getMessage());
        }


        if ($sqlConsultas) {
            return back()->with("correcto", "Paciente y sus consultas eliminados correctamente");
        } else {
            return back()->with("incorrecto", "Error al eliminar paciente o sus consultas");
        }
    }

}
