<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!--Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    <title>Editar Auxiliar</title>
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
        <h1 class="mt-5">Editar Auxiliar</h1>
        <a href="auxiliar.php" class="btn btn-secondary mb-3">Volver</a>
        <?php

        // Conexión
        require_once '../conexion.php';

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
            <div class="form-group">
                <label for="nombre_auxiliar" class="form-label">Nombre completo</label>
                <input type="text" class="form-control" id="nombre_auxiliar" name="nombre_auxiliar" value="<?php echo $row['nombre_auxiliar']; ?>" required>
            </div>
            <div class="form-group">
                <label for="dni_auxiliar" class="form-label">DNI</label>
                <input type="text" class="form-control" id="dni_auxiliar" name="dni_auxiliar" value="<?php echo $row['dni_auxiliar']; ?>" required>
            </div>
            <div class="form-group">
                <label for="direccion_auxiliar" class="form-label">Dirección</label>
                <input type="text" class="form-control" id="direccion_auxiliar" name="direccion_auxiliar" value="<?php echo $row['direccion_auxiliar']; ?>" required>
            </div>
            <div class="form-group">
                <label for="telefono_auxiliar" class="form-label">Teléfono</label>
                <input type="text" class="form-control" id="telefono_auxiliar" name="telefono_auxiliar" value="<?php echo $row['telefono_auxiliar']; ?>" required>
            </div>
            <div class="form-group">
                <label for="cargo_auxiliar" class="form-label">Cargo</label>
                <input type="text" class="form-control" id="cargo_auxiliar" name="cargo_auxiliar" value="<?php echo $row['cargo_auxiliar']; ?>" required>
            </div>
            <div class="form-group">
                <label for="observaciones_cargo" class="form-label">Observaciones del cargo</label>
                <input type="text" class="form-control" id="observaciones_cargo" name="observaciones_cargo" value="<?php echo $row['observaciones_cargo']; ?>" required>
            </div>
            <div class="form-group">
                <label for="categoria_afip" class="form-label">Categoría AFIP</label>
                <select class="form-control" id="categoria_afip" name="categoria_afip" required>
                    <option value="Monotributo" <?php if ($row['categoria_afip'] == 'Monotributo') echo 'selected'; ?>>Monotributo</option>
                    <option value="Autónomo" <?php if ($row['categoria_afip'] == 'Autónomo') echo 'selected'; ?>>Autónomo</option>
                    <option value="Responsable Inscripto" <?php if ($row['categoria_afip'] == 'Responsable Inscripto') echo 'selected'; ?>>Responsable Inscripto</option>
                    <option value="IVA Exento" <?php if ($row['categoria_afip'] == 'IVA Exento') echo 'selected'; ?>>IVA Exento</option>
                </select>
            </div>
            <div class="form-group">
                <label for="cuit_cuil" class="form-label">Cuit / Cuil</label>
                <input type="text" class="form-control" id="cuit_cuil" name="cuit_cuil" value="<?php echo $row['cuit_cuil']; ?>" required>
            </div>
            <div class="form-group">
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

