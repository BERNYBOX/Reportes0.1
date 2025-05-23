<?php
include_once("../conexion.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $descripcion = $_POST["descripcion"];
    $categoria = $_POST["categoria"];
    $cantidad = $_POST["cantidad"];
    $precio_unitario = $_POST["precio_unitario"];
    $itebis = $_POST["itebis"];
    $descuento = $_POST["descuento"];
    $total_general = $_POST["total_general"];

    if (!is_numeric($cantidad) || !is_numeric($precio_unitario) || !is_numeric($itebis) || !is_numeric($descuento) || !is_numeric($total_general)) {
        echo '<p class="error">Por favor, ingrese valores numéricos válidos.</p>';
        exit;
    }

    if ($cantidad < 0 || $precio_unitario < 0 || $itebis < 0 || $descuento < 0 || $total_general < 0) {
        echo '<p class="error">Los valores no pueden ser negativos.</p>';
        exit;
    }

    $sql = "INSERT INTO Facturas 
            (DESCRIPCION, CATEGORIA, CANTIDAD, PRECIO_UNITARIO, ITEBIS, DESCUENTO, TOTAL_GENERAL)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $params = [
        $descripcion,
        $categoria,
        $cantidad,
        $precio_unitario,
        $itebis,
        $descuento,
        $total_general
    ];

    $stmt = sqlsrv_query($conn, $sql, $params);

    if (!$stmt) {
        echo '<p class="error">Error al guardar la factura.</p>';
        die(print_r(sqlsrv_errors(), true));
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura</title>
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
        .back-button {
            grid-column: span 2;
            display: inline-block;
            text-align: center;
            padding: 12px;
            font-size: 0.8rem;
            font-family: 'Press Start 2P', cursive;
            background-color: #00ffcc;
            color: #000;
            border: none;
            text-decoration: none;
            box-shadow: 0 0 10px #00ffcc;
            border-radius: 10px;
            margin-top: 10px;
            transition: background-color 0.3s;
        }

        .back-button:hover {
            background-color: #00ccaa;
        }

    </style>
</head>
<body>

<div class="form-container">
    <h2>FACTURA</h2>

    <form method="post">
        <div>
            <label for="categoria">Categoría</label>
            <input type="text" id="categoria" name="categoria" required>
        </div>
        <div>
            <label for="cantidad">Cantidad</label>
            <input type="number" id="cantidad" name="cantidad" required>
        </div>
        <div>
            <label for="precio_unitario">Precio Unitario</label>
            <input type="number" step="0.01" id="precio_unitario" name="precio_unitario" required>
        </div>
        <div>
            <label for="itebis">ITEBIS</label>
            <input type="number" step="0.01" id="itebis" name="itebis" required>
        </div>
        <div>
            <label for="descuento">Descuento</label>
            <input type="number" step="0.01" id="descuento" name="descuento" required>
        </div>
        <div>
            <label for="total_general">Total General</label>
            <input type="number" step="0.01" id="total_general" name="total_general" required>
        </div>
        <div class="full-width">
            <label for="descripcion">Descripción</label>
            <input type="text" id="descripcion" name="descripcion" required>
        </div>
        <button type="submit">GUARDAR FACTURA</button>
        <a href="../menu.php" class="back-button">← VOLVER AL MENÚ</a>
    </form>
</div>

</body>
</html>
