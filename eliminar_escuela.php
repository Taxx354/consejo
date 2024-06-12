<?php
$servername = "localhost";
$username = "admin";
$password = "admin";ca
$dbname = "consejo";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$id = $_GET['id'];

$sql = "DELETE FROM escuela WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    echo "Registro eliminado correctamente";
} else {
    echo "Error eliminando el registro: " . $conn->error;
}

$conn->close();

header("Location: escuela.php");
exit();
?>
