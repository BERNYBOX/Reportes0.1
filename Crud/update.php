<?php
include_once("../conexion.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Consultar los datos actuales de la factura
    $query = "SELECT * FROM Facturas WHERE ID = ?";
    $stmt = sqlsrv_prepare($conn, $query, array(&$id));
    sqlsrv_execute($stmt);

    $factura = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

    if (!$factura) {
        die("Factura no encontrada.");
    }
}   else {
    die("ID de factura no válido.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $descripcion = $_POST['descripcion'];
    $categoria = $_POST['categoria'];
    $cantidad = $_POST['cantidad'];
    $precio_unitario = $_POST['precio_unitario'];
    $itebis = $_POST['itebis'];
    $descuento = $_POST['descuento'];
    $total_general = $_POST['total_general'];

    // Preparar la consulta para actualizar la factura
    $update_query = "UPDATE Facturas SET DESCRIPCION = ?, CATEGORIA = ?, CANTIDAD = ?, PRECIO_UNITARIO = ?, ITEBIS = ?, DESCUENTO = ?, TOTAL_GENERAL = ? WHERE ID = ?";
    $stmt_update = sqlsrv_prepare($conn, $update_query, array(
        &$descripcion, &$categoria, &$cantidad, &$precio_unitario, &$itebis, &$descuento, &$total_general, &$id
    ));

    if ($stmt_update === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    // Ejecutar la consulta
    if (sqlsrv_execute($stmt_update)) {
        header("Location: ../menu/index.php?message=Factura actualizada con éxito");
        exit();
    } else {
        echo "Error al actualizar la factura.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Factura</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Press Start 2P', cursive;
            background: linear-gradient(135deg, #0f0c29, #1f1b4d, #24133e);
            background-size: 400% 400%;
            animation: bgAnimation 10s ease infinite;
            color: #00ffcc;
            padding: 20px;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        @keyframes bgAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .form-container {
            background-color: #111;
            border: 4px solid #00ffcc;
            padding: 30px;
            border-radius: 16px;
            width: 700px;
            max-width: 100%;
            box-shadow: 0 0 25px #00ffcc;
        }

        h2 {
            text-align: center;
            font-size: 1rem;
            margin-bottom: 30px;
            color: #ffffff;
            font-weight: bold;
        }

        form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-size: 0.7rem;
            color: #ff00cc;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 10px;
            font-family: 'Press Start 2P', cursive;
            font-size: 0.7rem;
            border: 2px solid #00ffcc;
            background: #000;
            color: #00ffcc;
            border-radius: 16px;
        }

        input:focus {
            border-color: #ff00cc;
            outline: none;
        }

        .full-width {
            grid-column: span 2;
        }

        button {
            grid-column: span 2;
            padding: 12px;
            font-size: 0.8rem;
            font-family: 'Press Start 2P', cursive;
            background-color: #ff00cc;
            color: #000;
            border: none;
            cursor: pointer;
            box-shadow: 0 0 10px #ff00cc;
            border-radius: 10px;
        }

        button:hover {
            background-color: #cc00aa;
        }

        .error {
            color: #ff4444;
            text-align: center;
            margin-top: 15px;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Actualizar Factura</h2>

    <form action="update.php?id=<?php echo $id; ?>" method="POST">
        <div>
            <label for="descripcion">Descripción</label>
            <input type="text" id="descripcion" name="descripcion" value="<?php echo htmlspecialchars($factura['DESCRIPCION']); ?>" required>
        </div>
        <div>
            <label for="categoria">Categoría</label>
            <input type="text" id="categoria" name="categoria" value="<?php echo htmlspecialchars($factura['CATEGORIA']); ?>" required>
        </div>
        <div>
            <label for="cantidad">Cantidad</label>
            <input type="number" id="cantidad" name="cantidad" value="<?php echo htmlspecialchars($factura['CANTIDAD']); ?>" required>
        </div>
        <div>
            <label for="precio_unitario">Precio Unitario</label>
            <input type="number" step="0.01" id="precio_unitario" name="precio_unitario" value="<?php echo htmlspecialchars($factura['PRECIO_UNITARIO']); ?>" required>
        </div>
        <div>
            <label for="itebis">ITEBIS</label>
            <input type="number" step="0.01" id="itebis" name="itebis" value="<?php echo htmlspecialchars($factura['ITEBIS']); ?>" required>
        </div>
        <div>
            <label for="descuento">Descuento</label>
            <input type="number" step="0.01" id="descuento" name="descuento" value="<?php echo htmlspecialchars($factura['DESCUENTO']); ?>" required>
        </div>
        <div>
            <label for="total_general">Total General</label>
            <input type="number" step="0.01" id="total_general" name="total_general" value="<?php echo htmlspecialchars($factura['TOTAL_GENERAL']); ?>" required>
        </div>

        <button type="submit">Actualizar Factura</button>
    </form>
</div>

</body>
</html>

