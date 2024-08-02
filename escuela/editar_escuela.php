<?php
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

// Obtener ID de la escuela
$id_esc = $_GET['id'];

// Consulta SQL para obtener datos de la escuela
$sql = "SELECT * FROM escuela WHERE id_esc = $id_esc";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "No se encontró la escuela.";
    exit();
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

    <title>Editar Escuela</title>
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
        .form-group input, .form-group select {
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
        <h1 class="mt-5">Modificar registro</h1>
        <a href="escuela.php" class="btn btn-secondary mb-3">Volver</a>
        <form method="post" action="actualizar_escuela.php">
            <input type="hidden" name="id_esc" value="<?php echo $row['id_esc']; ?>">
            <div class="form-group">
                <label for="nombre_escuela" class="form-label">Nombre Escuela</label>
                <input type="text" class="form-control" id="nombre_escuela" name="nombre_escuela" value="<?php echo $row['nombre_escuela']; ?>" required>
            </div>
            <div class="form-group">
                <label for="direccion_escuela" class="form-label">Dirección Escuela</label>
                <input type="text" class="form-control" id="direccion_escuela" name="direccion_escuela" value="<?php echo $row['direccion_escuela']; ?>" required>
            </div>
            <div class="form-group">
                <label for="director" class="form-label">Director</label>
                <input type="text" class="form-control" id="director" name="director" value="<?php echo $row['director']; ?>" required>
            </div>
            <div class="form-group">
                <label for="vicedirector" class="form-label">Vicedirector</label>
                <input type="text" class="form-control" id="vicedirector" name="vicedirector" value="<?php echo $row['vicedirector']; ?>" required>
            </div>
            <div class="form-group">
                <label for="telefono_director" class="form-label">Teléfono Director</label>
                <input type="text" class="form-control" id="telefono_director" name="telefono_director" value="<?php echo $row['telefono_director']; ?>" required>
            </div>
            <div class="form-group">
                <label for="telefono_escuela" class="form-label">Teléfono Escuela</label>
                <input type="text" class="form-control" id="telefono_escuela" name="telefono_escuela" value="<?php echo $row['telefono_escuela']; ?>" required>
            </div>
            <div class="form-group">
                <label for="mail_escuela" class="form-label">Email Escuela</label>
                <input type="email" class="form-control" id="mail_escuela" name="mail_escuela" value="<?php echo $row['mail_escuela']; ?>" required>
            </div>
            <div class="form-group">
                <label for="rama_escuela" class="form-label">Rama Escuela</label>
                <select class="form-control" id="rama_escuela" name="rama_escuela" required>
                    <option value="Inicial" <?php if ($row['rama_escuela'] == 'Inicial') echo 'selected'; ?>>Inicial</option>
                    <option value="Primario" <?php if ($row['rama_escuela'] == 'Primario') echo 'selected'; ?>>Primario</option>
                    <option value="Secundario" <?php if ($row['rama_escuela'] == 'Secundario') echo 'selected'; ?>>Secundario</option>
                </select>
            </div>
            <div class="form-group">
                <label for="numero_escuela" class="form-label">Número Escuela</label>
                <input type="text" class="form-control" id="numero_escuela" name="numero_escuela" value="<?php echo $row['numero_escuela']; ?>" required>
            </div>
            <div class="form-group">
                <label for="cantidad_alumnos" class="form-label">Cantidad Alumnos</label>
                <input type="number" class="form-control" id="cantidad_alumnos" name="cantidad_alumnos" value="<?php echo $row['cantidad_alumnos']; ?>" required>
            </div>
            <div class="form-group">
                <label for="fecha_fundacion" class="form-label">Fecha Fundación</label>
                <input type="date" class="form-control" id="fecha_fundacion" name="fecha_fundacion" value="<?php echo $row['fecha_fundacion']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</body>
</html>


