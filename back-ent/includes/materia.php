<?php
require_once('database.php');

class Carrera {
   
    public static function create_materia($nombre_materia, $semestre, $docente, $descripcion) {
        $database = new Database();
        $conn = $database->getConnection();
        $stmt = $conn->prepare('INSERT INTO materia (nombre_materia, semestre, docente, descripcion)
            VALUES (:nombre_materia, :semestre, :docente, :descripcion)');
    
        $stmt->bindParam(':nombre_materia', $nombre_materia);
        $stmt->bindParam(':semestre', $semestre);
        $stmt->bindParam(':docente', $docente);
        $stmt->bindParam(':descripcion', $descripcion);
    
        if ($stmt->execute()) {
            http_response_code(201); // Establecer el código de respuesta 201 para indicar "Created"
            echo json_encode(array("message" => "Materia creada correctamente"));
        } else {
            http_response_code(404); // Establecer el código de respuesta 404 para indicar "Not Found"
            echo json_encode(array("message" => "No se ha podido crear la materia"));
        }
    }
    
    
    public static function delete_materiaID($id) {
        $database = new Database();
        $conn = $database->getConnection();
        $stmt = $conn->prepare('DELETE FROM materia WHERE id=:id');
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            header('HTTP/1.1 201 Materia borrada correctamente');
        } else {
            header('HTTP/1.1 404 no se ha borrado materia');
        } 
    }

    public static function get_all_materia() {
        $database = new Database();
        $conn = $database->getConnection();
        $stmt = $conn->prepare('SELECT * FROM materia');
        if ($stmt->execute()) {
            $result = $stmt->fetchAll();
            echo json_encode($result);
            header('HTTP/1.1 201 OK se ha consultado Materia correctamente');
        } else {
            header('HTTP/1.1 404 no se ha consultado materia');      
        }
    }
    public static function get_id_materia($id) {
        $database = new Database();
        $conn = $database->getConnection();
        $stmt = $conn->prepare('SELECT * FROM materia WHERE id=:id');
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            $result = $stmt->fetch();
            echo json_encode($result);
            return $result;
        } else {
            header('HTTP/1.1 404 no se ha encontrado el id de la  materia');
        } 
    }

    public static function update_materia($id, $nombre_materia, $semestre, $docente, $descripcion) {
        $database = new Database();
        $conn = $database->getConnection();

        $stmt = $conn->prepare('UPDATE materia SET nombre_materia=:nombre_materia,
            semestre=:semestre, docente=:docente, descripcion=:descripcion WHERE id=:id');
            
        $stmt->bindParam(':nombre_materia', $nombre_materia);
        $stmt->bindParam(':semestre', $semestre);
        $stmt->bindParam(':docente', $docente);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            header('HTTP/1.1 201 OK se ha actualizado la materia correctamente');
        } else {
            header('HTTP/1.1 404 no se ha actualizado la materia');
        }
    }
}
?>
