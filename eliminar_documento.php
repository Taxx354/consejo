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

// Corrección: usar id_documento en la consulta SQL
$sql = "DELETE FROM documentos WHERE id_documento = $id";

if ($conn->query($sql) === TRUE) {
    echo "Registro eliminado correctamente";
} else {
    echo "Error eliminando el registro: " . $conn->error;
}

$conn->close();

// Redirección después de la eliminación
header("Location: documento.php");
exit();
?>
