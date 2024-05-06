<?php
function get($url)
{
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  $response = curl_exec($ch);

  if ($response === false) {
    $error = curl_error($ch);
    curl_close($ch);
    throw new Exception('Error al ejecutar la petición: ' . $error);
  }

  $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

  if ($http_code >= 400) {
    curl_close($ch);
    throw new Exception('Error al obtener la respuesta: ' . $http_code);
  }

  curl_close($ch);

  return $response;
}

try {
  $url = 'http://localhost:81/APIRESTPHP_materia/back-ent/get_all_materia.php';
  $data = get($url);
  $materias = json_decode($data, true);
} catch (Exception $e) {
  echo 'Error: ' . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Carrera</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
</head>

<nav>
  <div class ="contendor">
    <a href="#">DATOS DE LA CARRERA</a>
</div>
</nav>

<body class="cuerpo">
  <div class="container">
    <div class="row">
    <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <form action="" method="POST" id="frm">
              <div class="form-group">
                <label for="">Nombre Materia</label>
                <input required type="text" name="nombre_materia" id="nombre_materia" placeholder="Nombre Materia" class="form-control">
              </div>
              <div class="form-group">
                <label for="">Semestre</label>
                <input type="text" name="semestre" id="semestre" placeholder="Semestre" class="form-control">
              </div>
              <div class="form-group">
                <label for="">Docente</label>
                <input type="text" name="docente" id="docente" placeholder="Docente" class="form-control">
              </div>
              <div class="form-group">
                <label for="">Descripción</label>
                <input type="text" name="descripcion" id="descripcion" placeholder="Descripción" class="form-control">
              </div>
              <div class="form-group d-flex d-row">
                <input type="button" value="Registrar" id="registrar" class="btn btn-outline-warning mt-4">
                <input type="button" value="Actualizar" id="actualizar" class="btn btn-outline-success mt-4" style="display: none;">
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- Tabla -->
      <input type="text" id="valueIdMateria" value="0">
      <div class="col-md-8">
        <div class="card">
          <div class="card-body">
          <table class="table table-striped table-hover table-primary table-bordered">
          
              <thead>
                <tr>
                  <th scope="col">Id</th>
                  <th scope="col">Materia</th>
                  <th scope="col">Semestre</th>
                  <th scope="col">Docente</th>
                  <th scope="col">Descripción</th>
                  <th scope="col">Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($materias as $materia) : ?>
                  <tr>
                    <th scope="row"><?= $materia['id'] ?></th>
                    <td><?= $materia['nombre_materia'] ?></td>
                    <td><?= $materia['semestre'] ?></td>
                    <td><?= $materia['docente'] ?></td>
                    <td><?= $materia['descripcion'] ?></td>
                    <td>
                   <button class="btn btn-warning editar-btn" id="editarvalor" data-id="<?= $materia['id'] ?>">Editar</button>
                      <button type='button' class='btn btn-danger' onclick="eliminarMateria(<?= $materia['id'] ?>)">Eliminar</button></td>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="./script.js"></script>
</body>

</html>
