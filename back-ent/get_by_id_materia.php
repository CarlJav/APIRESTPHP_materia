<?php
    require_once('includes\materia.php');

     if($_SERVER['REQUEST_METHOD']== 'GET' && isset($_GET["id"])){

         Carrera::get_id_materia($_GET["id"]);

     }else{
        echo "nose encontro el id";
     }
?>
