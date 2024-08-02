<?php
// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "consejo";

// Intentar la conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if($conn->connect_error){
    die("Conexion fallida: " . $conn->connect_error);
}
?>
