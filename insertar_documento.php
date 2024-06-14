<?php
// Datos de conexión
$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "consejo";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario a través de GET
$id_esc = $_GET['id_esc'];
$numero_documento = $_GET['numero_documento'];
$fecha = $_GET['fecha'];
$titulo = $_GET['titulo'];
$url = $_GET['url'];
$cuit_cuil = $_GET['cuit_cuil'];
$tipo_servicio = $_GET['tipo_servicio'];
$estado = $_GET['estado'];
$expediente = $_GET['expediente'];
$historial_legajo = $_GET['historial_legajo'];

// Consulta SQL para insertar datos
$sql = "INSERT INTO documentos (id_esc, numero_documento, fecha, titulo, url, cuit_cuil, tipo_servicio, estado, expediente, historial_legajo)
VALUES ('$id_esc', '$numero_documento', '$fecha', '$titulo', '$url', '$cuit_cuil', '$tipo_servicio', '$estado', '$expediente', '$historial_legajo')";

if ($conn->query($sql) === TRUE) {
    echo "Nuevo documento agregado exitosamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar conexión
$conn->close();

// Redirigir de vuelta a la página principal
header("Location: documento.php");
exit();
?>
