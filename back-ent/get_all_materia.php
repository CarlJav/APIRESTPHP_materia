<?php
    require_once('includes\materia.php');

     if($_SERVER['REQUEST_METHOD']== 'GET'){
         Carrera::get_all_materia();

     }
?>
