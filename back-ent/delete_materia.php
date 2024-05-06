<?php
require_once('includes\materia.php');

if($_SERVER['REQUEST_METHOD'] == 'DELETE' && isset($_GET['id'])) {
    Carrera::delete_materiaID($_GET['id']);
    echo "Materia eliminada correctamente";
} else {  
    echo "Solicitud no válida o falta el ID de la materia";
}
?>
