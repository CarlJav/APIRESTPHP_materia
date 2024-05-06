<?php
require_once('includes\materia.php');

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
  
    $data = json_decode(file_get_contents('php://input'), true);


    if (isset($data['id']) && isset($data['nombre_materia']) && isset($data['semestre']) &&
        isset($data['docente']) && isset($data['descripcion'])) {
        Carrera::update_materia($data['id'], $data['nombre_materia'], $data['semestre'],
                                $data['docente'], $data['descripcion']);
          http_response_code(200);
       
        echo json_encode(array("message" => "La materia se ha actualizado correctamente."));
    } else {
        http_response_code(400);
        echo json_encode(array("message" => "Faltan parámetros en la solicitud PUT."));
    }
} else {
    http_response_code(405);
    echo json_encode(array("message" => "Método no permitido. Se esperaba una solicitud PUT."));
}
?>
