<?php
require_once('includes\materia.php');

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nombre_materia']) && isset($_POST['semestre']) 
    && isset($_POST['docente']) && isset($_POST['descripcion'])) {

    Carrera::create_materia($_POST['nombre_materia'], $_POST['semestre'],
        $_POST['docente'], $_POST['descripcion']);
} else {
    echo "No se enviaron todos los datos";
}
?>
