<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Base de datos consejo escolar</title>
    <link rel="stylesheet" href="estilo.css">
    <style>
        
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
        }
        h1 {
            text-align: center;
            margin-bottom: 50px;
        }
        .button-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .button-container a {
            display: block;
            width: 200px;
            padding: 15px;
            text-align: center;
            text-decoration: none;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
            font-size: 18px;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        .button-container a:hover {
            background-color: #007bff;
        }
    </style>
</head>
<body>
    <h1>Base de datos consejo escolar</h1>
    <div class="button-container">
        <a href="documento/documento.php">Documentos</a>
        <a href="escuela/escuela.php">Escuelas</a>
        <a href="proveedores/proveedores.php">Proveedores</a>
        <a href="auxiliar/auxiliar.php">Auxiliares</a>
        <a href="legajo/legajo.php">Legajos</a>
    </div>
</body>
</html>
