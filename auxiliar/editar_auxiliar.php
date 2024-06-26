<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Auxiliar</title>
    <link rel="stylesheet" href="../estilo.css">
</head>
<body>
    <div class="container">
        <h1>Editar Auxiliar</h1>
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

        // Obtener ID del auxiliar
        $id_auxiliar = $_GET['id'];

        // Consulta para obtener los datos del auxiliar
        $sql = "SELECT * FROM auxiliar WHERE id_auxiliar = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_auxiliar);
        $stmt->execute();
        $result = $stmt->get_result();

        // Verificar si el auxiliar existe
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        ?>

        <!-- Formulario para editar auxiliar -->
        <form method="post" action="actualizar_auxiliar.php">
            <input type="hidden" name="id_auxiliar" value="<?php echo $row['id_auxiliar']; ?>">
            <div class="mb-3">
                <label for="nombre_auxiliar" class="form-label">Nombre completo</label>
                <input type="text" class="form-control" id="nombre_auxiliar" name="nombre_auxiliar" value="<?php echo $row['nombre_auxiliar']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="dni_auxiliar" class="form-label">DNI</label>
                <input type="text" class="form-control" id="dni_auxiliar" name="dni_auxiliar" value="<?php echo $row['dni_auxiliar']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="direccion_auxiliar" class="form-label">Direccion</label>
                <input type="text" class="form-control" id="direccion_auxiliar" name="direccion_auxiliar" value="<?php echo $row['direccion_auxiliar']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="telefono_auxiliar" class="form-label">Telefono</label>
                <input type="text" class="form-control" id="telefono_auxiliar" name="telefono_auxiliar" value="<?php echo $row['telefono_auxiliar']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="cargo_auxiliar" class="form-label">Cargo</label>
                <input type="text" class="form-control" id="cargo_auxiliar" name="cargo_auxiliar" value="<?php echo $row['cargo_auxiliar']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="observaciones_cargo" class="form-label">Observaciones del cargo</label>
                <input type="text" class="form-control" id="observaciones_cargo" name="observaciones_cargo" value="<?php echo $row['observaciones_cargo']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="categoria_afip" class="form-label">Categoria AFIP</label>
                <input type="text" class="form-control" id="categoria_afip" name="categoria_afip" value="<?php echo $row['categoria_afip']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="cuit_cuil" class="form-label">Cuit / Cuil</label>
                <input type="text" class="form-control" id="cuit_cuil" name="cuit_cuil" value="<?php echo $row['cuit_cuil']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="mail_auxiliar" class="form-label">Mail</label>
                <input type="email" class="form-control" id="mail_auxiliar" name="mail_auxiliar" value="<?php echo $row['mail_auxiliar']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>

        <?php
        } else {
            echo "<p>No se encontró el auxiliar.</p>";
        }

        // Cerrar conexión
        $stmt->close();
        $conn->close();
        ?>
    </div>
</body>
</html>
