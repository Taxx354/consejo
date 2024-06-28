<?php
// Verificar si se ha enviado un ID válido por GET
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID de proveedor no válido");
}

$id_proveedor = $_GET['id'];

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

// Consulta SQL para obtener los datos del proveedor por ID
$sql = "SELECT id_proveedor, nombre_proveedor, dni, direccion, telefono, tipo_servicio, observaciones_servicio, categoria_afip, cuit_cuil, mail FROM proveedor WHERE id_proveedor = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_proveedor);
$stmt->execute();
$result = $stmt->get_result();

// Verificar si se encontró el proveedor
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Datos del proveedor
    $nombre_proveedor = $row['nombre_proveedor'];
    $dni = $row['dni'];
    $direccion = $row['direccion'];
    $telefono = $row['telefono'];
    $tipo_servicio = $row['tipo_servicio'];
    $observaciones_servicio = $row['observaciones_servicio'];
    $categoria_afip = $row['categoria_afip'];
    $cuit_cuil = $row['cuit_cuil'];
    $mail = $row['mail'];
} else {
    echo "No se encontró el proveedor con ID: " . $id_proveedor;
    $conn->close();
    exit;
}

// Cerrar conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!--Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    <title>Editar Proveedor</title>
    <link rel="stylesheet" href="../estilo.css">
    <style>
        form {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 8px;
            font-size: 1rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-group button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Editar Proveedor</h1>
        <a href="proveedores.php" class="btn btn-secondary mb-3">Volver</a>
        <form method="post" action="actualizar_proveedor.php">
            <input type="hidden" name="id_proveedor" value="<?php echo $id_proveedor; ?>">
            <div class="form-group">
                <label for="nombre_proveedor">Nombre completo</label>
                <input type="text" id="nombre_proveedor" name="nombre_proveedor" value="<?php echo $nombre_proveedor; ?>" required>
            </div>
            <div class="form-group">
                <label for="dni">DNI</label>
                <input type="text" id="dni" name="dni" value="<?php echo $dni; ?>" required>
            </div>
            <div class="form-group">
                <label for="direccion">Dirección</label>
                <input type="text" id="direccion" name="direccion" value="<?php echo $direccion; ?>" required>
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="text" id="telefono" name="telefono" value="<?php echo $telefono; ?>" required>
            </div>
            <div class="form-group">
                <label for="tipo_servicio">Tipo de servicio</label>
                <input type="text" id="tipo_servicio" name="tipo_servicio" value="<?php echo $tipo_servicio; ?>" required>
            </div>
            <div class="form-group">
                <label for="observaciones_servicio">Observaciones de servicio</label>
                <input type="text" id="observaciones_servicio" name="observaciones_servicio" value="<?php echo $observaciones_servicio; ?>" required>
            </div>
            <div class="form-group">
                <label for="categoria_afip">Categoría AFIP</label>
                <input type="text" id="categoria_afip" name="categoria_afip" value="<?php echo $categoria_afip; ?>" required>
            </div>
            <div class="form-group">
                <label for="cuit_cuil">Cuit / Cuil</label>
                <input type="text" id="cuit_cuil" name="cuit_cuil" value="<?php echo $cuit_cuil; ?>" required>
            </div>
            <div class="form-group">
                <label for="mail">Mail</label>
                <input type="text" id="mail" name="mail" value="<?php echo $mail; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </form>
    </div>
</body>
</html>
