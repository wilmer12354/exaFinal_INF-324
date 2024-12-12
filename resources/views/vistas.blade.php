<div class="container py-4">
  <!-- Contenedor flex para alinear las tablas -->
  <div class="d-flex justify-content-between">
    
    <!-- Primera tabla (izquierda) -->
    <div class="table-responsive w-45">
      <table class="table table-dark table-striped table-bordered table-hover">
        <thead class="bg-primary text-white">
          <tr>
            <th scope="col">ID</th>
            <th scope="col">NOMBRE</th>
            <th scope="col">ESPECIALIDAD</th>
 
          </tr>
        </thead>
        <tbody class="table-group-divider">
          @foreach ($medicos as $medico)
          <tr>
            <th>{{$medico->id}}</th>
            <td>{{$medico->nombre}}</td>
            <td>{{$medico->especialidad_id}}</td>
           
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    
    <!-- Segunda tabla (derecha) -->
    <div class="table-responsive w-45">
      <table class="table table-dark table-striped table-bordered table-hover">
        <thead class="bg-primary text-white">
          <tr>
            <th scope="col">ID</th>
            <th scope="col">NOMBRE</th>

          </tr>
        </thead>
        <tbody class="table-group-divider">
          @foreach ($especialidades as $especialidad)
          <tr>
            <th>{{$especialidad->id}}</th>
            <td>{{$especialidad->nombre}}</td>

          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

  </div>
</div>
