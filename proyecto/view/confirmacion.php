<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f2f2f2;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #555;
            text-align: center;
        }

        p {
            margin-bottom: 10px;
        }

        .success {
            color: #4CAF50;
            font-weight: bold;
        }

        .error {
            color: #FF5733;
            font-weight: bold;
        }

        button {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Confirmación</h1>
        <?php
        if (isset($_POST['numeroTarjeta']) && isset($_POST['saldo'])) {
            $numeroTarjeta = htmlspecialchars($_POST['numeroTarjeta']);
            $saldo = htmlspecialchars($_POST['saldo']);

            // Conexión a la base de datos
            $servername = "localhost";
            $username = "proyectonfc";
            $password = "Root1234$";
            $dbname = "grancapitan";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Conexión fallida: " . $conn->connect_error);
            }

            $sql = "UPDATE usuarios JOIN usuarios_tarjetas ON usuarios.idUsuario = usuarios_tarjetas.idUsuario SET usuarios.saldo = usuarios.saldo + '$saldo' WHERE usuarios_tarjetas.idTarjeta = '$numeroTarjeta';";

            if ($conn->query($sql) === TRUE) {
                echo "<p class='success'>Recarga realizada correctamente</p>";
                echo "<p>Número de Tarjeta: $numeroTarjeta</p>";
                echo "<p>Saldo añadido: " . number_format($saldo / 100, 2) . "€</p>";
            } else {
                echo "<p class='error'>Error: " . $sql . "<br>" . $conn->error . "</p>";
            }

            $sql2 = "SELECT usuarios.saldo FROM usuarios JOIN usuarios_tarjetas ON usuarios.idUsuario = usuarios_tarjetas.idUsuario WHERE usuarios_tarjetas.idTarjeta = '$numeroTarjeta';";

            if ($result = $conn->query($sql2)) {
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo "<p>Saldo actual: " . number_format($row['saldo'] / 100, 2) . "€</p>";
                }
                $result->free();
            }
            $conn->close();

        } else {
            echo "<p class='error'>Error: Faltan datos para la confirmación.</p>";
            exit;
        }
        ?>
        <form action="takeawaysecretario.php" method="get">
            <button type="submit">Inicio</button>
        </form>
    </div>
</body>
</html>
