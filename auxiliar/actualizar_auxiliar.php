<?php
// Verificar si se ha enviado un ID válido por POST
if (!isset($_POST['id_auxiliar']) || empty($_POST['id_auxiliar'])) {
    die("ID de auxiliar no válido");
}

// Obtener los datos actualizados del formulario
$id_auxiliar = $_POST['id_auxiliar'];
$nombre_auxiliar = $_POST['nombre_auxiliar'];
$dni_auxiliar = $_POST['dni_auxiliar'];
$direccion_auxiliar = $_POST['direccion_auxiliar'];
$telefono_auxiliar = $_POST['telefono_auxiliar'];
$cargo_auxiliar = $_POST['cargo_auxiliar'];
$observaciones_cargo = $_POST['observaciones_cargo'];
$categoria_afip = $_POST['categoria_afip'];
$cuit_cuil = $_POST['cuit_cuil'];
$mail_auxiliar = $_POST['mail_auxiliar'];

// Datos de conexión
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "consejo";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta SQL para actualizar el auxiliar
$sql = "UPDATE auxiliar SET 
        nombre_auxiliar = ?,
        dni_auxiliar = ?,
        direccion_auxiliar = ?,
        telefono_auxiliar = ?,
        cargo_auxiliar = ?,
        observaciones_cargo = ?,
        categoria_afip = ?,
        cuit_cuil = ?,
        mail_auxiliar = ?
        WHERE id_auxiliar = ?";
        
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssssssi", $nombre_auxiliar, $dni_auxiliar, $direccion_auxiliar, $telefono_auxiliar, $cargo_auxiliar, $observaciones_cargo, $categoria_afip, $cuit_cuil, $mail_auxiliar, $id_auxiliar);

if ($stmt->execute()) {
    echo "Auxiliar actualizado correctamente.";
} else {
    echo "Error al actualizar el auxiliar: " . $stmt->error;
}

// Cerrar conexión
$stmt->close();
$conn->close();

// Redirigir a la página de auxiliar.php después de la actualización
header("Location: auxiliar.php");
exit();
?>
