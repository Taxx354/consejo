<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!--Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    <title>Editar Documento</title>
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
        <h1 class="mt-5">Editar Documento</h1>
        <a href="documento.php" class="btn btn-secondary mb-3">Volver</a>
        <?php
        
        // Conexión
        require_once '../conexion.php';

        // Obtener ID del documento
        $id_documento = $_GET['id'];

        // Consulta para obtener los datos del documento
        $sql = "SELECT * FROM documentos WHERE id_documento = $id_documento";
        $result = $conn->query($sql);

        // Verificar si el documento existe
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        ?>

        <!-- Formulario para editar documento -->
        <form method="post" action="insertar_documento.php">
            <input type="hidden" name="id_documento" value="<?php echo $row['id_documento']; ?>">
            <div class="form-group">
                <label for="id_esc" class="form-label">Escuela</label>
                <select name="id_esc" id="id_esc" class="form-control" required>
                    <option value="">Seleccione una escuela</option>
                    <?php
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Conexión fallida: " . $conn->connect_error);
                    }

                    $sql_escuelas = "SELECT id_esc, nombre_escuela FROM escuela";
                    $result_escuelas = $conn->query($sql_escuelas);

                    if ($result_escuelas->num_rows > 0) {
                        while ($row_escuela = $result_escuelas->fetch_assoc()) {
                            $selected = ($row['id_esc'] == $row_escuela["id_esc"]) ? "selected" : "";
                            echo "<option value='" . $row_escuela["id_esc"] . "' $selected>" . $row_escuela["nombre_escuela"] . "</option>";
                        }
                    }

                    $conn->close();
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo $row['fecha']; ?>" required>
            </div>
            <div class="form-group">
                <label for="link" class="form-label">Link</label>
                <input type="text" class="form-control" id="link" name="link" value="<?php echo $row['link']; ?>" required>
            </div>
            <div class="mb-3">
    <label for="cuit_cuil" class="form-label">Cuit / Cuil</label>
    <select name="cuit_cuil" class="form-control" required>
        <option value="">Seleccione un cuit/cuil</option>
        <?php
        
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
                <label for="tipo_servicio" class="form-label">Tipo de servicio</label>
                <input type="text" class="form-control" id="tipo_servicio" name="tipo_servicio" value="<?php echo $row['tipo_servicio']; ?>" required>
            </div>
            <div class="form-group">
                <label for="estado" class="form-label">Estado</label>
                <input type="text" class="form-control" id="estado" name="estado" value="<?php echo $row['estado']; ?>" required>
            </div>
            <div class="form-group">
                <label for="expediente" class="form-label">Expediente</label>
                <input type="text" class="form-control" id="expediente" name="expediente" value="<?php echo $row['expediente']; ?>" required>
            </div>
            <div class="mb-3">
            <form action="insertar_documento.php" method="post" enctype="multipart/form-data">
    <label for="historial_legajo">Selecciona un archivo (documento legajo):</label>
    <input type="file" id="avatar" name="avatar" accept="" />
    <br>
    <input type="submit" value="Enviar Archivo" />
    </div>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>

        <?php
        } else {
            echo "<p>Documento no encontrado.</p>";
        }

        ?>
    </div>
</body>
</html>
