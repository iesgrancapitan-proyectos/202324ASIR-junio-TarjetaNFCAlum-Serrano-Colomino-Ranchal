<?php
session_start();
$servername = "localhost";
$username = "proyectonfc";
$password = "Root1234$";
$dbname = "grancapitan";
$port = 3306;

$conexion = mysqli_connect($servername, $username, $password, $dbname, $port);

if (!$conexion) {
    die("Conexión fallida: " . mysqli_connect_error());
}

$numeroTarjeta = htmlspecialchars($_GET['numeroTarjeta']);

$sql2 = "SELECT usuarios.idUsuario, usuarios.nombre, usuarios.email, usuarios.nie, usuarios.unidad, usuarios.departamento, usuarios.idPerfil, usuarios.last_present, usuarios.mayor_edad, usuarios.saldo, usuarios_tarjetas.idUserTarje, usuarios_tarjetas.idTarjeta FROM usuarios JOIN usuarios_tarjetas ON usuarios.idUsuario=usuarios_tarjetas.idUsuario WHERE usuarios_tarjetas.idTarjeta='$numeroTarjeta';";
$result = mysqli_query($conexion, $sql2);

if ($result) {
    $user = mysqli_fetch_assoc($result);
} else {
    die("User data not found.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['codigo'])) {
    $codigo = mysqli_real_escape_string($conexion, $_POST['codigo']);
    $sql2 = "SELECT * FROM productos WHERE codigo='$codigo'";
    $result = mysqli_query($conexion, $sql2);

    if (mysqli_num_rows($result) > 0) {
        $item = mysqli_fetch_assoc($result);
        $user_id = $user['idUsuario'];
        $item_id = $item['idProducto'];

        $sql2 = "INSERT INTO carro (idUsuario, idProducto, cantidad) VALUES ('$user_id', '$item_id', 1)
                ON DUPLICATE KEY UPDATE cantidad=cantidad+1";
        mysqli_query($conexion, $sql2);
    } else {
        $error = "Artículo no encontrado.";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['eliminar_idCarro'])) {
    $idCarro = intval($_POST['eliminar_idCarro']);
    $user_id = $user['idUsuario'];

    $sql2 = "DELETE FROM carro WHERE idCarro='$idCarro' AND idUsuario='$user_id'";
    mysqli_query($conexion, $sql2);
}

$sql2 = "SELECT productos.nombre, productos.precio, SUM(carro.cantidad) as cantidad, productos.codigo, MIN(carro.idCarro) as idCarro FROM carro
        JOIN productos ON carro.idProducto=productos.idProducto
        WHERE carro.idUsuario={$user['idUsuario']}
        GROUP BY productos.codigo";
$carro_productos = mysqli_query($conexion, $sql2);

$carro_vacio = (mysqli_num_rows($carro_productos) == 0);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['comprar'])) {
    if ($carro_vacio) {
        $error_compra = "El carrito está vacío. Por favor, añada algún artículo.";
    } else {
        header("Location: checkoutexterior.php?numeroTarjeta=" . urlencode($numeroTarjeta));
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- header('Content-Type: text/html; charset=ISO-8859-1');-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style_menuadmin.css">
    <link rel="stylesheet" type="text/css" href="/style/style_aseo.css" media="screen" />
    <title></title>
    <link rel="shortcut icon" href="IMG/favicon2.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@600&display=swap" rel="stylesheet">

    <style>
        body {
            text-align: center;
        }
        .masthead {
            position: relative;
            width: 100%;
            height: auto;
            padding: 5px 0px; /* Padding personalizado a este fichero*/
            background-image: url(fondo23.png);
            background-repeat: no-repeat;
            background-size: 70%;
            background-position: center;
            font-family: 'Montserrat Alternates', sans-serif;
        }
        .lista-sin-puntos {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        .space-between {
            margin-top: 50px;
        }
    </style>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>

<body id="page">
<div id="divnav" class="container px-4 px-lg-5">
    <img id="logonav" src="Marcahorizontal.jpg" alt="IES GRAN CAPITÁN" alt="" />
</div>
<div class="container">
</div>
<div class="masthead">
    <header class="mb-5">
        <div class="p-5 text-center" style="margin-top: 58px;">
            <h1 class="mb-3">Bienvenido/a a Takeaway</h1>
        </div>
    </header>

    <h1>Usted es el usuario <?php echo htmlspecialchars($numeroTarjeta); ?></h1>
    <p>Saldo: <?php echo number_format($user['saldo'] / 100, 2); ?>€</p>
    <p>Pulse en el recuadro y escanee el código de barras</p>
    <form method="post" action="">
        Código de barras: <input type="text" name="codigo" autofocus required>
        <button type="submit">Añadir al carrito</button>
    </form>
    <?php if (isset($error)) { echo htmlspecialchars($error); } ?>

    <h2>Carrito</h2>
    <ul class="lista-sin-puntos">
        <?php 
        $total = 0; // Inicializar variable para el total
        while($item = mysqli_fetch_assoc($carro_productos)): 
            $subtotal = $item['precio'] * $item['cantidad']; // Calcular subtotal del item
            $total += $subtotal; // Añadir subtotal al total
        ?>
            <li>
                Artículo - <?php echo number_format($item['precio'] / 100, 2); ?>€ x <?php echo htmlspecialchars($item['cantidad']); ?>
                <form method="post" action="" style="display:inline;">
                    <input type="hidden" name="eliminar_idCarro" value="<?php echo htmlspecialchars($item['idCarro']); ?>">
                    <button type="submit">Eliminar</button>
                </form>
            </li>
        <?php endwhile; ?>
    </ul>

    <!-- Mostrar total -->
    <h3>Total: <?php echo number_format($total / 100, 2); ?>€</h3>

    <div class="space-between"></div>

    <form method="post" action="" class="space-after">
        <button type="submit" name="comprar">Comprar</button>
    </form>

    <?php if (isset($error_compra)) { ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($error_compra); ?></div>
    <?php } ?>

    <div class="space-between"></div>

    <footer class="py-2 fixed-bottom">
        <p class="text-center text-muted">Rafael Castillero | Javier Mariscal | Miguel Ángel Pintado | Juan Ranchal | Alfonso Colomino | Jaime Serrano | 2023/2024</p>
    </footer>
</body>
</html>