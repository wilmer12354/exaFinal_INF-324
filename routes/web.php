<?php

use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\PacienteController;
use Illuminate\Support\Facades\Route;

/*
 PRIMERA TABLA
*/ 
Route::get("/",[PacienteController::class,"index"])->name("crud.paciente.index");

//ruta para añadir un nuevo paciente
Route::get("/registrar-paciente",[PacienteController::class,"create"])->name("crud.paciente.create");

//ruta para modificar un paciente
Route::post("/modificar-paciente",[PacienteController::class,"update"])->name("crud.paciente.update");

//ruta para eliminar un paciente
Route::get("/eliminar-paciente-{id}",[PacienteController::class,"delete"])->name("crud.paciente.delete");


/*
 SEGUNDA TABLA
*/ 
Route::get("/otra-tabla", [ConsultaController::class, "index"])->name("crud.consulta.index");

//ruta para añadir un nuevo consulta
Route::post("/registrar-consulta",[ConsultaController::class,"create"])->name("crud.consulta.create");

//ruta para modificar un consulta
Route::post("/modificar-consulta",[ConsultaController::class,"update"])->name("crud.consulta.update");

//ruta para eliminar un consulta
Route::get("/eliminar-consulta-{id}",[ConsultaController::class,"delete"])->name("crud.consulta.delete");


