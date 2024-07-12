<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

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
        .navbar {
            margin-bottom: 20px;
        }
        .navbar-nav .nav-link {
            padding: 10px 15px;
            font-size: 16px;
        }
        nav {
            background-color: #eee;
            padding: 1em;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: space-around;
        }

        nav a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }

        section {
            padding: 2em;
        }

        footer {
            background-color: rgba(51, 51, 51, 0.9);
            color: #fff;
            text-align: center;
            padding: 1em;
            position: fixed;
            bottom: 0;
            width: 100%;
            z-index: 0;
        }
        .navbar {
    margin-bottom: 20px;
}
.navbar-nav .nav-link {
    padding: 10px 15px;
    font-size: 16px;
}
nav {
    background-color: #eee;
    padding: 1em;
}

nav ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: space-around;
}

nav a {
    text-decoration: none;
    color: #333;
    font-weight: bold;
}

section {
    padding: 2em;
}

footer {
    background-color: rgba(51, 51, 51, 0.9);
    color: #fff;
    text-align: center;
    padding: 1em;
    position: fixed;
    bottom: 0;
    width: 100%;
    z-index: 0;
}
    </style>
</head>
<body>
    <div class="container">
         <!-- Barra de navegación -->
         <!-- Barra de navegación -->
         <nav>
        <ul>
            <li><a href="../index.php">Volver a inicio</a></li>
            <li><a href="../proveedores/proveedores.php">Proveedores</a></li>
            <li><a href="../escuela/escuela.php">Escuelas</a></li>
            <li><a href="../legajo/legajo.php">Legajos</a></li>
            <li><a href="../auxiliar/auxiliar.php">Auxiliares</a></li>
            <li><em>Documentos</em></li>
        </ul>
        </nav>
        <h1 class="mt-5">Lista de Documentos</h1>

        <!-- Buscador -->
        <h3>Buscar por título o por Cuit/Cuil:</h3>
        <form method="get" action="">
            <input type="text" name="search" placeholder="" value="<?php echo isset($_GET['search']) ? $_GET['search'] : '' ?>">
            <input type="submit" value="Buscar">
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

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Conexión fallida: " . $conn->connect_error);
                }

                // Consulta SQL para obtener documentos
                $search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
                $sql = "SELECT id_documento, id_esc, fecha, titulo, link, cuit_cuil, tipo_servicio, estado, expediente, historial_legajo 
        FROM documentos 
        WHERE titulo LIKE '%$search%' 
        OR cuit_cuil LIKE '%$search%'"; 

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
                        echo "<td><a href='" . $row["historial_legajo"] . "'>Ver archivo</a></td>"; // Enlace para ver el archivo
                        echo "<td>";
                        echo "<a href='eliminar_documento.php?id=" . $row["id_documento"] . "' class='btn btn-danger'><i class='fas fa-trash-alt'></i></a> ";
                        echo "<a href='editar_documento.php?id=" . $row["id_documento"] . "' class='btn btn-primary'><i class='fas fa-edit'></i></a>";
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
        <form method="post" action="insertar_documento.php" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="id_esc" class="form-label">Escuela</label>
                <select name="id_esc" id="id_esc" class="form-control" required>
                    <option value="">Seleccione una escuela</option>
                    <?php
                    // Conexión a la base de datos para obtener id_esc y nombre_escuela
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Conexión fallida: " . $conn->connect_error);
                    }

                    $sql_escuelas = "SELECT id_esc, nombre_escuela FROM escuela";
                    $result_escuelas = $conn->query($sql_escuelas);

                    if ($result_escuelas->num_rows > 0) {
                        while ($row_escuela = $result_escuelas->fetch_assoc()) {
                            echo "<option value='" . $row_escuela["id_esc"] . "'>" . $row_escuela["nombre_escuela"] . "</option>";
                        }
                    }

                    $conn->close();
                    ?>
                </select>
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

                    if ($result_proveedores->num_rows > 0) {
                        while ($row_proveedor = $result_proveedores->fetch_assoc()) {
                            echo "<option value='" . $row_proveedor["cuit_cuil"] . "'>" . $row_proveedor["nombre_proveedor"] . " (" . $row_proveedor["cuit_cuil"] . ")</option>";
                        }
                    }

                    $conn->close();
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="tipo_servicio" class="form-label">Tipo de Servicio</label>
                <input type="text" class="form-control" id="tipo_servicio" name="tipo_servicio" required>
            </div>
            <div class="mb-3">
                <label for="estado" class="form-label">Estado</label>
                <select class="form-control" id="estado" name="estado" required>
                    <option value="">Seleccione un estado</option>
                    <option value="Inicio">Inicio</option>
                    <option value="En proceso">En proceso</option>
                    <option value="Finalizado">Finalizado</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="expediente" class="form-label">Expediente</label>
                <input type="text" class="form-control" id="expediente" name="expediente" required>

            </div>
            <div class="mb-3">
                <label for="historial_legajo" class="form-label">Documento Legajo</label>
                <input type="file" class="form-control" id="historial_legajo" name="historial_legajo" required>
            </div>
            <button type="submit" class="btn btn-primary">Agregar Documento</button>
        </form>
    </div>
</body>
</html>
