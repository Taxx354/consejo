<?php
// Verificar si se ha enviado un ID válido por GET
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID de escuela no válido");
}

$id_escuela = $_GET['id'];

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

// Consulta SQL para obtener los datos de la escuela por ID
$sql = "SELECT * FROM escuela WHERE id_esc = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_escuela);
$stmt->execute();
$result = $stmt->get_result();

// Verificar si se encontró la escuela
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Datos de la escuela
    $nombre_escuela = $row['nombre_escuela'];
    $direccion_escuela = $row['direccion_escuela'];
    $director = $row['director'];
    $vicedirector = $row['vicedirector'];
    $telefono_director = $row['telefono_director'];
    $telefono_escuela = $row['telefono_escuela'];
    $mail_escuela = $row['mail_escuela'];
    $rama_escuela = $row['rama_escuela'];
    $numero_escuela = $row['numero_escuela'];
    $cantidad_alumnos = $row['cantidad_alumnos'];
    $fecha_fundacion = $row['fecha_fundacion'];
} else {
    echo "No se encontró la escuela con ID: " . $id_escuela;
    $conn->close();
    exit;
}

// Cerrar conexión
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Escuela</title>
    <link rel="stylesheet" href="../estilo.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Editar Escuela</h1>
        <form method="post" action="actualizar_escuela_proceso.php">
            <input type="hidden" name="id_escuela" value="<?php echo $id_escuela; ?>">
            <div class="form-group">
                <label for="nombre_escuela">Nombre Escuela</label>
                <input type="text" id="nombre_escuela" name="nombre_escuela" value="<?php echo $nombre_escuela; ?>" required>
            </div>
            <div class="form-group">
                <label for="direccion_escuela">Dirección Escuela</label>
                <input type="text" id="direccion_escuela" name="direccion_escuela" value="<?php echo $direccion_escuela; ?>" required>
            </div>
            <div class="form-group">
                <label for="director">Director</label>
                <input type="text" id="director" name="director" value="<?php echo $director; ?>" required>
            </div>
            <div class="form-group">
                <label for="vicedirector">Vicedirector</label>
                <input type="text" id="vicedirector" name="vicedirector" value="<?php echo $vicedirector; ?>" required>
            </div>
            <div class="form-group">
                <label for="telefono_director">Teléfono Director</label>
                <input type="text" id="telefono_director" name="telefono_director" value="<?php echo $telefono_director; ?>" required>
            </div>
            <div class="form-group">
                <label for="telefono_escuela">Teléfono Escuela</label>
                <input type="text" id="telefono_escuela" name="telefono_escuela" value="<?php echo $telefono_escuela; ?>" required>
            </div>
            <div class="form-group">
                <label for="mail_escuela">Email Escuela</label>
                <input type="email" id="mail_escuela" name="mail_escuela" value="<?php echo $mail_escuela; ?>" required>
            </div>
            <div class="form-group">
                <label for="rama_escuela">Rama Escuela</label>
                <select id="rama_escuela" name="rama_escuela" required>
                    <option value="Inicial" <?php if ($rama_escuela === 'Inicial') echo 'selected'; ?>>Inicial</option>
                    <option value="Primario" <?php if ($rama_escuela === 'Primario') echo 'selected'; ?>>Primario</option>
                    <option value="Secundario" <?php if ($rama_escuela === 'Secundario') echo 'selected'; ?>>Secundario</option>
                </select>
            </div>
            <div class="form-group">
                <label for="numero_escuela">Número Escuela</label>
                <input type="text" id="numero_escuela" name="numero_escuela" value="<?php echo $numero_escuela; ?>" required>
            </div>
            <div class="form-group">
                <label for="cantidad_alumnos">Cantidad Alumnos</label>
                <input type="number" id="cantidad_alumnos" name="cantidad_alumnos" value="<?php echo $cantidad_alumnos; ?>" required>
            </div>
            <div class="form-group">
                <label for="fecha_fundacion">Fecha Fundación</label>
                <input type="date" id="fecha_fundacion" name="fecha_fundacion" value="<?php echo $fecha_fundacion; ?>" required>
            </div>
            <button type="submit">Guardar cambios</button>
        </form>
    </div>
</body>
</html>
