<?php
// Conexión
require_once '../conexion.php';

$id = $_GET['id'];

// Eliminar el registro
$sql = "DELETE FROM auxiliar WHERE id_auxiliar = $id";

if ($conn->query($sql) === TRUE) {
    echo "Registro eliminado correctamente";
    
    // Verificar si hay registros restantes en la tabla
    $result = $conn->query("SELECT COUNT(*) AS total FROM auxiliar");
    $row = $result->fetch_assoc();
    if ($row['total'] == 0) {
        // Reiniciar AUTO_INCREMENT a 1 si no hay registros
        $conn->query("TRUNCATE TABLE auxiliar");
    } else {
        // Verificar si el ID eliminado es el mayor en la tabla
        $result = $conn->query("SELECT MAX(id_auxiliar) AS max_id FROM auxiliar");
        $row = $result->fetch_assoc();
        $max_id = $row['max_id'];
        
        if ($max_id < $id) {
            // Reiniciar AUTO_INCREMENT al ID eliminado
            $conn->query("ALTER TABLE auxiliar AUTO_INCREMENT = $id");
        }
    }
} else {
    echo "Error eliminando el registro: " . $conn->error;
}

$conn->close();

// Redirección después de la eliminación
header("Location: auxiliar.php");
exit();
?>
