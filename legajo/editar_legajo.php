<?php
// Verificar si se recibió un ID válido por GET
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID de legajo no válido");
}

$id_legajo = $_GET['id'];

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

// Consulta SQL para obtener los datos del legajo
$sql = "SELECT cuit_cuil, historial_legajo FROM legajo WHERE id_legajo = $id_legajo";
$result = $conn->query($sql);

// Verificar si se encontró el legajo
if ($result === false || $result->num_rows == 0) {
    die("Legajo no encontrado");
}

$row = $result->fetch_assoc();
$cuit_cuil = $row['cuit_cuil'];
$historial_legajo = $row['historial_legajo'];

// Cerrar conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Legajo</title>
    <link rel="stylesheet" href="../estilo.css">
    <style>
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
        <h1 class="mt-5">Editar Legajo</h1>
        <form method="post" action="insertar_legajo.php">
            <input type="hidden" name="id_legajo" value="<?php echo $id_legajo; ?>">
            <div class="form-group">
                <label for="cuit_cuil" class="form-label">Cuit / Cuil</label>
                <input type="text" class="form-control" id="cuit_cuil" name="cuit_cuil" value="<?php echo $cuit_cuil; ?>" required>
            </div>
            <div class="form-group">
                <label for="historial_legajo" class="form-label">Documento Legajo</label>
                <input type="text" class="form-control" id="historial_legajo" name="historial_legajo" value="<?php echo $historial_legajo; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
    </div>
</body>
</html>
