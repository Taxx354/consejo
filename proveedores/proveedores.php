<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Legajos</title>
    <link rel="stylesheet" href="estilo.css">
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
        <h1 class="mt-5">Lista de proveedores</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Proveedor</th>
                    <th>Nombre proveedor</th>
                    <th>DNI</th>
                    <th>Direccion </th>
                    <th>Telefono</th>
                    <th>Tipo de servicio</th>
                    <th>Observaciones servicio</th>
                    <th>Categoria AFIP</th>
                    <th>Cuit / Cuil</th>
                    <th>Mail</th>
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

                // Consulta SQL
                $sql = "SELECT id_proveedor, nombre_proveedor, dni, direccion, telefono, tipo_servicio, observaciones_servicio, categoria_afip, cuit_cuil, mail FROM proveedor"; // Asegúrate de que la tabla se llama 'proveedor' y tiene estas columnas
                $result = $conn->query($sql);

                // Verificar si la consulta fue exitosa
                if ($result === false) {
                    echo "<tr><td colspan='3'>Error en la consulta: " . $conn->error . "</td></tr>";
                } else {
                    // Verificar si hay resultados
                    if ($result->num_rows > 0) {
                        // Mostrar datos por cada fila
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["id_proveedor"] . "</td>";
                            echo "<td>" . $row["nombre_proveedor"] . "</td>";
                            echo "<td>" . $row["dni"] . "</td>";
                            echo "<td>" . $row["direccion"] . "</td>";
                            echo "<td>" . $row["telefono"] . "</td>";
                            echo "<td>" . $row["tipo_servicio"] . "</td>";
                            echo "<td>" . $row["observaciones_servicio"] . "</td>";
                            echo "<td>" . $row["categoria_afip"] . "</td>";
                            echo "<td>" . $row["cuit_cuil"] . "</td>";
                            echo "<td>" . $row["mail"] . "</td>";
                            echo "<td><a href='eliminar_proveedor.php?id=" . $row["id_proveedor"] . "' class='btn btn-danger'>Eliminar</a></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No hay datos disponibles</td></tr>";
                    }
                }

                // Cerrar conexión
                $conn->close();
                ?>
            </tbody>
        </table>

        <!-- Formulario para agregar nuevo legajo -->
        <h2>Agregar Nuevo proveedor</h2>
        <form method="post" action="insertar_proveedor.php">
            <div class="mb-3">
                <label for="dni" class="form-label">DNI</label>
                <input type="text" class="form-control" id="dni" name="dni" required>
            </div>
            <div class="mb-3">
                <label for="direccion" class="form-label">Direccion</label>
                <input type="text" class="form-control" id="direccion" name="direccion" required>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Telefono</label>
                <input type="text" class="form-control" id="telefono" name="telefono" required>
            </div>
            <div class="mb-3">
                <label for="tipo_servicio" class="form-label">Tipo de servicio</label>
                <input type="text" class="form-control" id="tipo_servicio" name="tipo_servicio" required>
            </div>
            <div class="mb-3">
                <label for="observaciones_servicio" class="form-label">Observaciones de servicio</label>
                <input type="text" class="form-control" id="observaciones_servicio" name="observaciones_servicio" required>
            </div>
            <div class="mb-3">
                <label for="categoria_afip" class="form-label">Categoria AFIP</label>
                <input type="text" class="form-control" id="categoria_afip" name="categoria_afip" required>
            </div>
            <div class="mb-3">
                <label for="cuit_cuil" class="form-label">Cuit / Cuil</label>
                <input type="text" class="form-control" id="cuit_cuil" name="cuit_cuil" required>
            </div>
            <div class="mb-3">
                <label for="mail" class="form-label">Mail</label>
                <input type="text" class="mail" id="cuit_cuil" name="mail" required>
            </div>


            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</body>
</html>