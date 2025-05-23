<?php
include_once("../conexion.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Facturas</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Press Start 2P', cursive;
            background: linear-gradient(135deg, #0f0c29, #302b63, #24243e);
            background-size: 400% 400%;
            animation: bgAnimation 10s ease infinite;
            color: #00ffcc;
            padding: 20px;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh;
        }

        @keyframes bgAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .header {
            width: 100%;
            background-color: #111;
            padding: 15px;
            text-align: center;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 999;
        }

        .header h1 {
            margin: 0;
            font-size: 1.5rem;
            color: #00ffcc;
        }

        .back-button {
            position: absolute;
            right: 20px;
            top: 10px;
            padding: 10px 15px;
            font-size: 1rem;
            color: #fff;
            background-color: #ff00cc;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .back-button:hover {
            background-color: #cc0099;
        }

        .table-container {
            background-color: #111;
            border: 4px solid #00ffcc;
            padding: 15px;
            border-radius: 16px;
            max-width: 90%;
            box-shadow: 0 0 15px #00ffcc;
            text-align: center;
            overflow-x: auto;
            margin-top: 70px;
        }

        h2 {
            font-size: 1.5rem;
            color: #ffffff;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            table-layout: auto;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            text-align: center;
            font-size: 0.8rem;
            border: 2px solid #00ffcc;
            margin: 5px;
        }

        th {
            background-color: #00ffcc;
            color: #000;
        }

        td {
            background-color: #1f1f1f;
            color: #00ffcc;
        }

        a {
            color: #ff00cc;
            text-decoration: none;
            padding: 4px 8px;
            border: 2px solid #ff00cc;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        a:hover {
            background-color: #ff00cc;
            color: #000;
        }

        .action-button {
            display: inline-block;
            padding: 8px 16px;
            margin: 5px;
            background-color: #ff00cc;
            color: #fff;
            text-decoration: none;
            border: 2px solid #ff00cc;
            border-radius: 5px;
            font-size: 0.9rem;
            text-align: center;
            transition: background-color 0.3s, color 0.3s;
        }

        .action-button:hover {
            background-color: #cc0099;
            color: #000;
        }
                .generate-pdf-button {
            position: absolute;
            left: 20px;
            top: 10px;
            padding: 10px 15px;
            font-size: 1rem;
            color: #fff;
            background-color: #00ccff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .generate-pdf-button:hover {
            background-color: #0099cc;
        }

    </style>
</head>
<body>

<div class="header">
    <h1>Lista de Facturas</h1>
    <a href="../menu.php" class="back-button">Volver al Menú</a>    
    <a href="generar_facturas_pdf.php" class="generate-pdf-button" target="_blank">Generar PDF</a>

</div>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Descripción</th>
                <th>Categoría</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>ITEBIS</th>
                <th>Descuento</th>
                <th>Total General</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $query = "SELECT * FROM Facturas";
                $stmt = sqlsrv_query($conn, $query);
                if ($stmt === false) {
                    die(print_r(sqlsrv_errors(), true));
                }
                
                $hayDatos = false;
                while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)):
                    $hayDatos = true;
            ?>
                <tr>
                    <td><?php echo $row['ID']; ?></td>
                    <td><?php echo $row['DESCRIPCION']; ?></td>
                    <td><?php echo $row['CATEGORIA']; ?></td>
                    <td><?php echo $row['CANTIDAD']; ?></td>
                    <td><?php echo $row['PRECIO_UNITARIO']; ?></td>
                    <td><?php echo $row['ITEBIS']; ?></td>  
                    <td><?php echo $row['DESCUENTO']; ?></td>
                    <td><?php echo $row['TOTAL_GENERAL']; ?></td>
                    <td>
                        <a href="../Crud/update.php?id=<?php echo $row['ID']; ?>" class="action-button">Actualizar</a>
                        <a href="../Crud/delete.php?id=<?php echo $row['ID']; ?>" class="action-button">Eliminar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>
