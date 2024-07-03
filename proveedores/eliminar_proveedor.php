<?php
$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "consejo";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$id = $_GET['id'];

// Eliminar el registro
$sql = "DELETE FROM proveedor WHERE id_proveedor = $id";

if ($conn->query($sql) === TRUE) {
    echo "Registro eliminado correctamente";
    
    // Verificar si hay registros restantes en la tabla
    $result = $conn->query("SELECT COUNT(*) AS total FROM proveedor");
    $row = $result->fetch_assoc();
    if ($row['total'] == 0) {
        // Reiniciar AUTO_INCREMENT a 1 si no hay registros
        $conn->query("TRUNCATE TABLE proveedor");
    } else {
        // Verificar si el ID eliminado es el mayor en la tabla
        $result = $conn->query("SELECT MAX(id_proveedor) AS max_id FROM proveedor");
        $row = $result->fetch_assoc();
        $max_id = $row['max_id'];
        
        if ($max_id < $id) {
            // Reiniciar AUTO_INCREMENT al ID eliminado
            $conn->query("ALTER TABLE proveedor AUTO_INCREMENT = $id");
        }
    }
} else {
    echo "Error eliminando el registro: " . $conn->error;
}

$conn->close();

// Redirección después de la eliminación
header("Location: proveedores.php");
exit();
?>
