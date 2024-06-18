<?php
if (isset($_POST['numeroTarjeta'])) {
    $numeroTarjeta = htmlspecialchars($_POST['numeroTarjeta']);
} else {
    echo "<p>Error: No se ha introducido el número de tarjeta.</p>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            text-align: center;
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 50%;
        }
        form {
            margin: 20px 0;
        }
        button {
            margin: 15px;
            padding: 15px 30px;
            font-size: 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button[name="saldo"][value="500"] {
            background-color: #69BC37;
        }
        button[name="saldo"][value="1000"] {
            background-color: #FF5733;
        }
        button[name="saldo"][value="2000"] {
            background-color: #0074D9;
        }
        button[name="saldo"][value="5000"] {
            background-color: #F39C12;
        }
        button[type="submit"] {
            background-color: #3498db;
            color: white;
        }
        button[type="submit"]:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <div class="container">
        <p>Número de Tarjeta: <?php echo $numeroTarjeta; ?></p>
        <form action="confirmacion.php" method="post">
            <input type="hidden" name="numeroTarjeta" value="<?php echo $numeroTarjeta; ?>">
            <label for="saldo">Selecciona el saldo:</label><br>
            <button type="submit" name="saldo" value="500">5 euros</button>
            <button type="submit" name="saldo" value="1000">10 euros</button>
            <button type="submit" name="saldo" value="2000">20 euros</button>
            <button type="submit" name="saldo" value="5000">50 euros</button>
        </form>
        <form action="takeawaysecretario.php" method="get">
            <button type="submit">Cancelar</button>
        </form>
    </div>
</body>
</html>