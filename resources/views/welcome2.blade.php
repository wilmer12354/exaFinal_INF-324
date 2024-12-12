<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Laravel - Pacientes</title>

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/0d79259bcd.js" crossorigin="anonymous"></script>
</head>

<body class="bg-dark text-white">
    <!-- Header -->
    <header class="container">
        <h1 class="text-center p-2">CRUD en Laravel CONSULTAS</h1>


        <!-- Alertas -->
        @if (session("correcto"))
            <div class="alert alert-success">{{session("correcto")}}</div>
        @endif

        @if (session("incorrecto"))
            <div class="alert alert-danger">{{session("incorrecto")}}</div>
        @endif

        @if (session("sin_modificar"))
            <div class="alert alert-warning">{{session("sin_modificar")}}</div>
        @endif
    </header>

    <!-- Contenido Principal -->
    <main class="container p-5">
        <!-- Contenedor para los botones -->
        <!-- Contenedor para los botones -->
        <div class="d-flex justify-content-between mb-3">
            <!-- Botón Ir a la lista de pacientes a la derecha -->
            <a href="{{ route('crud.paciente.index') }}" class="btn btn-success">
                <i class="fa-solid fa-arrow-right"></i> Ir a la lista de pacientes
            </a>

            <!-- Botón Añadir a la izquierda -->
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalRegistrar">
                Añadir Consulta
            </button>
        </div>




        <!-- Tabla de Consultas -->
        <div class="table-responsive">
            <table class="table table-dark table-striped table-bordered table-hover">
                <thead class="bg-primary text-white">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">ID_PACIENTE</th>
                        <th scope="col">ID_MEDICO</th>
                        <th scope="col">FECHA</th>
                        <th scope="col">DIAGNOSTICO</th>
                        <th scope="col">OPERACIONES</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($datos as $item)
                        <tr>
                            <th>{{$item->id}}</th>
                            <td>{{$item->paciente_id}}</td>
                            <td>{{$item->medico_id}}</td>
                            <td>{{$item->fecha}}</td>
                            <td>{{$item->diagnostico}}</td>
                            <td class="text-center">
                                <a href="" data-bs-toggle="modal" data-bs-target="#modalEditar{{$item->id}}"
                                    class="btn btn-warning btn-sm">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a href="{{route("crud.consulta.delete", $item->id)}}"
                                    onclick="return confirmarEliminacion()" class="btn btn-danger btn-sm">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>

                        <!-- Modal Editar -->
                        <div class="modal fade" id="modalEditar{{$item->id}}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content bg-dark text-light">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-light">Modificar datos de la Consulta</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('crud.consulta.update') }}" method="POST">
                                            @csrf
                                            @method('POST')

                                            <!-- ID de la consulta (readonly) -->
                                            <div class="mb-3">
                                                <label class="form-label">ID de la consulta</label>
                                                <input type="text" class="form-control" name="txtid" value="{{$item->id}}"
                                                    readonly>
                                            </div>

                                            <!-- Selección de Paciente -->
                                            <div class="mb-3">
                                                <label class="form-label">Paciente</label>
                                                <select class="form-select" name="txtidpaciente">
                                                    @foreach ($pacientes as $paciente)
                                                        <option value="{{ $paciente->id }}" {{ $paciente->id == $item->paciente_id ? 'selected' : '' }}>
                                                            {{ $paciente->nombre }} {{ $paciente->apellido }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Selección de Médico -->
                                            <div class="mb-3">
                                                <label class="form-label">Médico</label>
                                                <select class="form-select" name="txtidmedico">
                                                    @foreach ($medicos as $medico)
                                                        <option value="{{ $medico->id }}" {{ $medico->id == $item->medico_id ? 'selected' : '' }}>
                                                            {{ $medico->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Fecha de consulta -->
                                            <div class="mb-3">
                                                <label class="form-label">Fecha</label>
                                                <input type="date" class="form-control" name="txtfecha"
                                                    value="{{$item->fecha}}">
                                            </div>

                                            <!-- Diagnóstico -->
                                            <div class="mb-3">
                                                <label class="form-label">Diagnóstico</label>
                                                <input type="text" class="form-control" name="txtdiagnostico"
                                                    value="{{$item->diagnostico}}">
                                            </div>

                                            <!-- Botones del Modal -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cerrar</button>
                                                <button type="submit" class="btn btn-primary">Modificar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach
                </tbody>
            </table>
        </div>
    </main>

    <!-- Modal Registrar -->
    <div class="modal fade" id="modalRegistrar" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-dark text-light">
                <div class="modal-header">
                    <h5 class="modal-title text-light">Registrar Consulta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('crud.consulta.create') }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="mb-3">
                            <label class="form-label">ID de la consulta</label>
                            <input type="text" class="form-control" name="txtid">
                        </div>

                        <!-- Selección de Paciente -->
                        <div class="mb-3">
                            <label class="form-label">Paciente</label>
                            <select class="form-select" name="txtidpaciente">
                                <option value="">Seleccione un paciente</option>
                                @foreach ($pacientes as $paciente)
                                    <option value="{{ $paciente->id }}">
                                        {{ $paciente->nombre }} {{ $paciente->apellido }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Selección de Médico -->
                        <div class="mb-3">
                            <label class="form-label">Médico</label>
                            <select class="form-select" name="txtidmedico">
                                <option value="">Seleccione un médico</option>
                                @foreach ($medicos as $medico)
                                    <option value="{{ $medico->id }}">
                                        {{ $medico->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Fecha de consulta -->
                        <div class="mb-3">
                            <label class="form-label">Fecha</label>
                            <input type="date" class="form-control" name="txtfecha">
                        </div>

                        <!-- Diagnóstico -->
                        <div class="mb-3">
                            <label class="form-label">Diagnóstico</label>
                            <input type="text" class="form-control" name="txtdiagnostico">
                        </div>

                        <!-- Botones del Modal -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Registrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    @include('vistas')

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script>
        function confirmarEliminacion() {
            return confirm("¿Estás seguro de eliminar a esta consulta?");
        }
    </script>
</body>

</html>