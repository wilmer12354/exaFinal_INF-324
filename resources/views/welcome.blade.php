<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Laravel - Pacientes</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <script src="https://kit.fontawesome.com/0d79259bcd.js" crossorigin="anonymous"></script>
</head>

<body class="bg-dark text-white">
    <!-- Header -->
    <header class="container">
        <h1 class="text-center p-2">CRUD en Laravel PACIENTES</h1>


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
        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route('crud.consulta.index') }}" class="btn btn-success">
                <i class="fa-solid fa-arrow-right"></i> Ir a la lista de pacientes
            </a>

            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalRegistrar">
                Añadir Paciente
            </button>
        </div>


        <!-- Tabla de Pacientes -->
        <div class="table-responsive">
            <table class="table table-dark table-striped table-bordered table-hover">
                <thead class="bg-primary text-white">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">NOMBRE</th>
                        <th scope="col">APELLIDO</th>
                        <th scope="col">FECHA-NACIMIENTO</th>
                        <th scope="col">TELEFONO</th>
                        <th scope="col">OPERACIONES</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($pacientes as $paciente)
                        <tr>
                            <th>{{$paciente->id}}</th>
                            <td>{{$paciente->nombre}}</td>
                            <td>{{$paciente->apellido}}</td>
                            <td>{{$paciente->fecha_nacimiento}}</td>
                            <td>{{$paciente->telefono}}</td>
                            <td class="text-center">
                                <a href="" data-bs-toggle="modal" data-bs-target="#modalEditar{{$paciente->id}}"
                                    class="btn btn-warning btn-sm">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a href="{{route("crud.paciente.delete", $paciente->id)}}"
                                    onclick="return confirmarEliminacion()" class="btn btn-danger btn-sm">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>

                        <!-- Modal Editar -->
                        <div class="modal fade" id="modalEditar{{$paciente->id}}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-dark">Modificar datos del Paciente</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route("crud.paciente.update")}}" method="POST">
                                            @csrf
                                            @method('POST')
                                            <div class="mb-3">
                                                <label class="form-label">ID del Paciente</label>
                                                <input type="text" class="form-control" name="txtid" value="{{$paciente->id}}">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Nombre</label>
                                                <input type="text" class="form-control" name="txtnombre"
                                                    value="{{$paciente->nombre}}">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Apellido</label>
                                                <input type="text" class="form-control" name="txtapellido"
                                                    value="{{$paciente->apellido}}">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Fecha de nacimiento</label>
                                                <input type="date" class="form-control" name="txtdate"
                                                    value="{{$paciente->fecha_nacimiento}}">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Teléfono</label>
                                                <input type="text" class="form-control" name="txttelefono"
                                                    value="{{$paciente->telefono}}">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Cerrar
                                                </button>
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
                    <h5 class="modal-title text-light">Registrar Paciente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route("crud.paciente.create")}}" method="get">
                        <div class="mb-3">
                            <label class="form-label">ID del Paciente</label>
                            <input type="text" class="form-control" name="txtid">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="txtnombre">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Apellido</label>
                            <input type="text" class="form-control" name="txtapellido">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Fecha de nacimiento</label>
                            <input type="date" class="form-control" name="txtdate">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Teléfono</label>
                            <input type="text" class="form-control" name="txttelefono">
                        </div>
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
            return confirm("¿Estás seguro de eliminar a este paciente?");
        }
    </script>
</body>

</html>