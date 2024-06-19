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

// Obtener datos del formulario
$id_esc = $_POST['id_esc'];
$fecha = $_POST['fecha'];
$titulo = $_POST['titulo'];
$link = $_POST['link'];
$cuit_cuil = $_POST['cuit_cuil'];
$tipo_servicio = $_POST['tipo_servicio'];
$estado = $_POST['estado'];
$expediente = $_POST['expediente'];
$historial_legajo = $_POST['historial_legajo'];

// Consulta SQL para insertar datos
$sql = "INSERT INTO documentos (id_documento, id_esc, fecha, titulo, link, cuit_cuil, tipo_servicio, estado, expediente, historial_legajo) VALUES (NULL, '$id_esc', '$fecha', '$titulo', '$link', '$cuit_cuil', '$tipo_servicio', '$estado', '$expediente', '$historial_legajo')";
//var_dump($sql);
//die;
if ($conn->query($sql) === TRUE) {
    echo "Nueva escuela agregada exitosamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar conexión
$conn->close();

// Redirigir de vuelta a la página principal
header("Location: documento.php");
exit();
?>
