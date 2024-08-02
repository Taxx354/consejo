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
    
    <title>Lista de Legajos</title>
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
        .btn-filter {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
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
         <nav>
        <ul>
            <li><a href="../index.php">Volver a inicio</a></li>
            <li><a href="../proveedores/proveedores.php">Proveedores</a></li>
            <li><a href="../escuela/escuela.php">Escuelas</a></li>
            <li><em>Legajos</em></li>
            <li><a href="../auxiliar/auxiliar.php">Auxiliares</a></li>
            <li><a href="../documento/documento.php">Documentos</a></li>
        </ul>
        </nav>
    </nav>
        <h1 class="mt-5">Lista de Legajos</h1>
<br>
        <form method="post" action="">
            <button type="submit" name="filter" value="Todo" class="btn-filter">Mostrar todos</button>
            <button type="submit" name="filter" value="Proveedor" class="btn-filter">Filtrar Proveedores</button>
            <button type="submit" name="filter" value="Auxiliar" class="btn-filter">Filtrar Auxiliares</button>
        </form>
        <!-- Buscador -->
         <br>
  <h3>Buscar por título:</h3>
        <form method="get" action="">
            <input type="text" name="search" placeholder="Buscar por CUIT/CUIL" value="<?php echo isset($_GET['search']) ? $_GET['search'] : '' ?>">
            <input type="submit" value="Buscar" style= "padding: 1px 12px;">
            <input type="button" value="Reiniciar" onclick="window.location.href='?';" style="padding: 1px 16px; margin-left: 5px;">
            </form>
<br>
 
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Legajo</th>
                    <th>Cuit / Cuil</th>
                    <th>Documento Legajo</th>
                    <th>Proveedor o Auxiliar</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
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

                $filter = $_POST['filter'] ?? '';

                // Consulta SQL según el filtro
                if ($filter === 'Proveedor') {
                    $sql = "SELECT * FROM legajo WHERE proveedor_auxiliar = 'Proveedor'";
                } elseif ($filter === 'Auxiliar') {
                    $sql = "SELECT * FROM legajo WHERE proveedor_auxiliar = 'Auxiliar'";
                } else {
                    $sql = "SELECT * FROM legajo";
                }

                $result = $conn->query($sql);

                // Verificar si la consulta fue exitosa
                if ($result === false) {
                    echo "<tr><td colspan='5'>Error en la consulta: " . $conn->error . "</td></tr>";
                } else {
                    // Verificar si hay resultados
                    if ($result->num_rows > 0) {
                        // Mostrar datos por cada fila
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["id_legajo"] . "</td>";
                            echo "<td>" . $row["cuit_cuil"] . "</td>";
                            echo "<td>" . $row["historial_legajo"] . "</td>";
                            echo "<td>" . $row["proveedor_auxiliar"] . "</td>";
                            echo "<td>";
                            echo "<a href='eliminar_legajo.php?id=" . $row["id_legajo"] . "' class='btn btn-danger'><i class='fas fa-trash-alt'></i></a> ";
                            echo "<a href='editar_legajo.php?id=" . $row["id_legajo"] . "' class='btn btn-primary'><i class='fas fa-edit'></i></a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No hay datos disponibles</td></tr>";
                    }
                }

                // Cerrar conexión
                $conn->close();
                ?>
            </tbody>
        </table>

        <!-- Formulario para agregar nuevo legajo -->
         <br>
        <h2>Agregar Nuevo Legajo</h2>
        <form method="post" action="insertar_legajo.php">
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
                <input type="text" class="form-control" id="historial_legajo" name="historial_legajo" required>
            </div>
            <div class="form-group">
                <label for="proveedor_auxiliar" class="form-label">Proveedor o auxiliar</label>
                <select class="form-control" id="proveedor-auxiliar" name="proveedor_auxiliar" required>
                    <option value="">Seleccione si es proveedor o auxiliar</option>
                    <option value="Proveedor">Proveedor</option>
                    <option value="Auxiliar">Auxiliar</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>

</body>
</html>
