<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Principal</title>
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
            height: 100vh;
        }

        @keyframes bgAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .menu-container {
            background-color: #111;
            border: 4px solid #00ffcc;
            padding: 30px;
            border-radius: 16px;
            width: 700px;
            max-width: 100%;
            box-shadow: 0 0 25px #00ffcc;
            text-align: center;
        }

        h2 {
            font-size: 2rem;
            color: #ffffff;
            margin-bottom: 30px;
        }

        .button-container {
            display: flex;
            justify-content: space-around;
            gap: 20px;
        }

        .button-container button {
            padding: 12px 25px;
            font-size: 1.2rem;
            font-family: 'Press Start 2P', cursive;
            background-color: #ff00cc;
            color: #000;
            border: none;
            cursor: pointer;
            box-shadow: 0 0 10px #ff00cc;
            border-radius: 10px;
            transition: background-color 0.3s;
        }

        .button-container button:hover {
            background-color: #cc00aa;
        }
    </style>
</head>
<body>

<div class="menu-container">
    <h2>Menú Principal</h2>
    <div class="button-container">
        <a href="menu/index.php">
            <button>Ir al Índice</button>
        </a>
        <a href="Crud/insert.php">
            <button>Agregar Factura</button>
        </a>
    </div>
</div>

</body>
</html>
