<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consejo escolar</title>
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
            background: linear-gradient(135deg, #f0f0f0 25%, #c0c0c0 100%);
            background-attachment: fixed;
            animation: backgroundAnimation 10s ease-in-out infinite alternate;
        }
        
        @keyframes backgroundAnimation {
            0% { background-position: 0% 50%; }
            100% { background-position: 100% 50%; }
        }

        h1 {
            text-align: center;
            margin-bottom: 50px;
            font-size: 36px;
            color: #333;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            animation: textGlow 2s ease-in-out infinite alternate;
        }
        
        @keyframes textGlow {
            0% { text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3); }
            100% { text-shadow: 2px 2px 20px rgba(0, 0, 0, 0.6); }
        }

        .button-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .button-container a {
            display: block;
            width: 250px; 
            padding: 20px; 
            text-align: center;
            text-decoration: none;
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
            border-radius: 5px;
            font-size: 18px;
            font-weight: bold;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            transition: background 0.3s, transform 0.3s, box-shadow 0.3s;
        }

        .button-container a:hover {
            background: linear-gradient(135deg, #0056b3, #007bff);
            transform: scale(1.05);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
        }

        footer {
            margin-top: auto;
            padding: 10px;
            text-align: center;
        }

        footer p {
            margin: 0;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <h1>Consejo Escolar</h1>
    <div class="button-container">
        <a href="proveedores/proveedores.php">Proveedores</a>
        <a href="escuela/escuela.php">Escuelas</a>
        <a href="legajo/legajo.php">Legajos</a>
        <a href="auxiliar/auxiliar.php">Auxiliares</a>
        <a href="documento/documento.php">Documentos</a>
    </div>

    <footer>
        <p><em>© 2024 INFO - E.E.S.T N°1 Magdalena</em></p>
    </footer>
</body>
</html>
