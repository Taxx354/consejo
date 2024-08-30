<?php
// Verificar si se recibió un ID válido por GET
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID de legajo no válido");
}

$id_legajo = $_GET['id'];

        // Conexión
        require_once '../conexion.php';

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
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!--Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    <title>Editar Legajo</title>
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
        <h1 class="mt-5">Editar Legajo</h1>
        <a href="legajo.php" class="btn btn-secondary mb-3">Volver</a>
        <form method="post" action="actualizar_legajo.php">
            <input type="hidden" name="id_legajo" value="<?php echo $id_legajo; ?>">
            <div class="form-group">
            <label for="cuit_cuil" class="form-label">Cuit / Cuil</label>
                <select name="cuit_cuil" id="cuit_cuil" class="form-control" required>
                    <option value="">Seleccione un cuit/cuil</option>
                    <?php
                    // Conexión a la base de datos para obtener cuit/cuil y nombre_auxiliar
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Conexión fallida: " . $conn->connect_error);
                    }

                    $sql_auxiliares = "SELECT cuit_cuil, nombre_auxiliar FROM auxiliar";
                    $result_auxiliares = $conn->query($sql_auxiliares);

                    if ($result_auxiliares->num_rows > 0) {
                        while ($row_auxiliar = $result_auxiliares->fetch_assoc()) {
                            echo "<option value='" . $row_auxiliar["cuit_cuil"] . "'>" . $row_auxiliar["nombre_auxiliar"] . " (" . $row_auxiliar["cuit_cuil"] . ")</option>";
                        }
                    }
                    $sql_proveedores = "SELECT cuit_cuil, nombre_proveedor FROM proveedor";
                    $result_proveedores = $conn->query($sql_proveedores);
            
                    // Verificar y mostrar resultados de la tabla proveedor
                    if ($result_proveedores->num_rows > 0) {
                        while ($row_proveedor = $result_proveedores->fetch_assoc()) {
                            echo "<option value='" . $row_proveedor["cuit_cuil"] . "'>" . $row_proveedor["nombre_proveedor"] . " (" . $row_proveedor["cuit_cuil"] . ")</option>";
                        }
                    }
                    $conn->close();
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="historial_legajo" class="form-label">Documento Legajo</label>
                <input type="text" class="form-control" id="historial_legajo" name="historial_legajo" value="<?php echo $historial_legajo; ?>" required>
            </div>
<!--             <div class="form-group">
                <label for="proveedor_auxiliar" class="form-label">Proveedor o auxiliar</label>
                <select class="form-control" id="proveedor-auxiliar" name="proveedor_auxiliar" required>
                <option value="">Seleccione un cuit/cuil</option>
                    <option value="proveedor">Proveedor</option>
                    <option value="auxiliar">Auxiliar</option>
                </select>
            </div> -->
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
    </div>
</body>
</html>


