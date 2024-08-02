<?php
// Verificar si se han enviado los datos por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se recibieron todos los datos necesarios
    if (isset($_POST['id_proveedor']) && isset($_POST['nombre_proveedor']) && isset($_POST['dni']) && isset($_POST['direccion']) && isset($_POST['telefono']) && isset($_POST['tipo_servicio']) && isset($_POST['observaciones_servicio']) && isset($_POST['categoria_afip']) && isset($_POST['cuit_cuil']) && isset($_POST['mail'])) {
        
        // Recibir datos del formulario
        $id_proveedor = $_POST['id_proveedor'];
        $nombre_proveedor = $_POST['nombre_proveedor'];
        $dni = $_POST['dni'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
        $tipo_servicio = $_POST['tipo_servicio'];
        $observaciones_servicio = $_POST['observaciones_servicio'];
        $categoria_afip = $_POST['categoria_afip'];
        $cuit_cuil = $_POST['cuit_cuil'];
        $mail = $_POST['mail'];

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

        // Preparar la consulta SQL para actualizar el proveedor
        $sql = "UPDATE proveedor SET nombre_proveedor=?, dni=?, direccion=?, telefono=?, tipo_servicio=?, observaciones_servicio=?, categoria_afip=?, cuit_cuil=?, mail=? WHERE id_proveedor=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssssi", $nombre_proveedor, $dni, $direccion, $telefono, $tipo_servicio, $observaciones_servicio, $categoria_afip, $cuit_cuil, $mail, $id_proveedor);

        // Ejecutar la consulta y verificar si fue exitosa
        if ($stmt->execute()) {
            // Redireccionar a proveedores.php después de actualizar
            header("Location: proveedores.php");
            exit(); // Asegurar que se detiene la ejecución después de la redirección
        } else {
            echo "Error al actualizar el proveedor: " . $stmt->error;
        }

        // Cerrar declaración y conexión
        $stmt->close();
        $conn->close();

    } else {
        echo "No se recibieron todos los datos necesarios para actualizar el proveedor";
    }
} else {
    echo "Acceso no autorizado";
}
?>
