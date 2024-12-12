<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PacienteController extends Controller
{
    public function index()
{
    // Consultar todos los datos de las tres tablas
    $pacientes = DB::select("select * from pacientes");
    $medicos = DB::select("select * from medicos");
    /*
        $medicos = DB::table('medicos')
        ->join('especialidades', 'medicos.especialidad_id', '=', 'especialidades.id')
        ->select('medicos.id as medico_id', 'medicos.nombre as medico_nombre', 'especialidades.nombre as especialidad_nombre')
        ->get();
     */
    $especialidades = DB::select("select * from especialidades");

    // Pasar los datos a la vista
    return view("welcome")->with([
        'pacientes' => $pacientes,
        'medicos' => $medicos,
        'especialidades' => $especialidades
    ]);
}


    public function create(Request $request)
    {

        try {

            $sql = DB::insert("insert into pacientes(id, nombre, apellido, fecha_nacimiento, telefono) values(?,?,?,?,?)", [
                $request->txtid,
                $request->txtnombre,
                $request->txtapellido,
                $request->txtdate,
                $request->txttelefono
            ]);
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == true) {
            return back()->with("correcto", "Paciente registrado correctamente");
        } else {
            return back()->with("incorrecto", "Error al registrar");
        }
    }

    public function update(Request $request)
    {
        try {
            $sql = DB::update("update pacientes set nombre=?, apellido=?, fecha_nacimiento=?, telefono=? where id=? ", [

                $request->txtnombre,
                $request->txtapellido,
                $request->txtdate,
                $request->txttelefono,
                $request->txtid
            ]);
            if ($sql == 0) {
                return back()->with("sin_modificar", "No se modificó ningún dato...");
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }
        if ($sql == true) {
            return back()->with("correcto", "Paciente modificado correctamente");
        } else {
            return back()->with("incorrecto", "Error al modificar");
        }
    }
    public function delete($id)
    {
        try {
            $sqlConsultas = DB::delete("DELETE FROM consultas WHERE paciente_id = ?", [$id]);
            $sqlPaciente = DB::delete("DELETE FROM pacientes WHERE id = ?", [$id]);

        } catch (\Throwable $th) {
            return back()->with("incorrecto", "Error al eliminar: " . $th->getMessage());
        }

        if ($sqlConsultas && $sqlPaciente) {
            return back()->with("correcto", "Paciente y sus consultas eliminados correctamente");
        } else {
            return back()->with("incorrecto", "Error al eliminar paciente o sus consultas");
        }
    }


}
