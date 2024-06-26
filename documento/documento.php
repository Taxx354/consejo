<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de documentos</title>
    <link rel="stylesheet" href="../estilo.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Lista de Documentos</h1>
        <h3>Selecciona una redirección:</h3>
        <form action="../redireccionar.php" method="post">
            <select name="redireccion">
                <option value="escuela/escuela.php">Escuelas</option>
                <option value="auxiliar/auxiliar.php">Auxiliares</option>
                <option value="proveedores/proveedores.php">Proveedores</option>
                <option value="legajo/legajo.php">Legajos</option>
            </select>
            <br><br>
            <input type="submit" value="Redireccionar">
        </form>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Documento</th>
                    <th>ID Escuela</th>
                    <th>Fecha</th>
                    <th>Título</th>
                    <th>Link</th>
                    <th>Cuit / Cuil</th>
                    <th>Tipo de servicio</th>
                    <th>Estado</th>
                    <th>Expediente</th>
                    <th>Documento Legajo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
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

                // Consulta SQL para obtener documentos
                $sql = "SELECT id_documento, id_esc, fecha, titulo, link, cuit_cuil, tipo_servicio, estado, expediente, historial_legajo FROM documentos";
                $result = $conn->query($sql);

                // Verificar si hay resultados
                if ($result->num_rows > 0) {
                    // Mostrar datos por cada fila
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id_documento"] . "</td>";
                        echo "<td>" . $row["id_esc"] . "</td>";
                        echo "<td>" . $row["fecha"] . "</td>";
                        echo "<td>" . $row["titulo"] . "</td>";
                        echo "<td><a href='" . $row["link"] . "'>" . $row["link"] . "</a></td>";
                        echo "<td>" . $row["cuit_cuil"] . "</td>";
                        echo "<td>" . $row["tipo_servicio"] . "</td>";
                        echo "<td>" . $row["estado"] . "</td>";
                        echo "<td>" . $row["expediente"] . "</td>";
                        echo "<td>" . $row["historial_legajo"] . "</td>";
                        echo "<td>";
                        echo "<a href='eliminar_documento.php?id=" . $row["id_documento"] . "' class='btn btn-danger'>Eliminar</a> ";
                        echo "<a href='editar_documento.php?id=" . $row["id_documento"] . "' class='btn btn-warning'>Modificar</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='11'>No hay datos disponibles</td></tr>";
                }

                // Cerrar conexión
                $conn->close();
                ?>
            </tbody>
        </table>

        <!-- Formulario para agregar nuevo documento -->
        <h2>Agregar Nuevo Documento</h2>
        <form method="post" action="insertar_documento.php">
            <div class="mb-3">
                <label for="id_esc" class="form-label">Escuela</label>
                <input type="text" class="form-control" id="id_esc" name="id_esc" required>
            </div>
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" class="form-control" id="fecha" name="fecha" required>
            </div>
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" required>
            </div>
            <div class="mb-3">
                <label for="link" class="form-label">Link</label>
                <input type="text" class="form-control" id="link" name="link" required>
            </div>
            <div class="mb-3">
                <label for="cuit_cuil" class="form-label">Cuit / Cuil</label>
                <select name="cuit_cuil" class="form-control" required>
                    <option value="">Seleccione un cuit/cuil</option>
                    <?php
                    // Consulta SQL para obtener CUIT/CUIL y nombres de auxiliares
                    $sql_auxiliares = "SELECT cuit_cuil, nombre_auxiliar AS nombre FROM auxiliares";
                    $result_auxiliares = $conn->query($sql_auxiliares);

                    if ($result_auxiliares->num_rows > 0) {
                        while ($row_auxiliar = $result_auxiliares->fetch_assoc()) {
                            echo "<option value='" . $row_auxiliar["cuit_cuil"] . "'>" . $row_auxiliar["nombre"] . " (" . $row_auxiliar["cuit_cuil"] . ")</option>";
                        }
                    }

                    // Consulta SQL para obtener CUIT/CUIL y nombres de proveedores
                    $sql_proveedores = "SELECT cuit_cuil, nombre_proveedor AS nombre FROM proveedores";
                    $result_proveedores = $conn->query($sql_proveedores);

                    if ($result_proveedores->num_rows > 0) {
                        while ($row_proveedor = $result_proveedores->fetch_assoc()) {
                            echo "<option value='" . $row_proveedor["cuit_cuil"] . "'>" . $row_proveedor["nombre"] . " (" . $row_proveedor["cuit_cuil"] . ")</option>";
                        }
                    }

                    // Cerrar conexión
                    $conn->close();
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="tipo_servicio" class="form-label">Tipo de servicio</label>
                <input type="text" class="form-control" id="tipo_servicio" name="tipo_servicio" required>
            </div>
            <div class="mb-3">
                <label for="estado" class="form-label">Estado</label>
                <input type="text" class="form-control" id="estado" name="estado" required>
            </div>
            <div class="mb-3">
                <label for="expediente" class="form-label">Expediente</label>
                <input type="text" class="form-control" id="expediente" name="expediente" required>
            </div>
            <div class="mb-3">
                <label for="historial_legajo" class="form-label">Documento Legajo</label>
                <input type="text" class="form-control" id="historial_legajo" name="historial_legajo" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</body>
</html>


