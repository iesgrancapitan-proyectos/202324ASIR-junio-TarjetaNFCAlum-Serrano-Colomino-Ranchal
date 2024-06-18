<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style_menuadmin.css">
    <link rel="stylesheet" type="text/css" href="/style/style_aseo.css" media="screen" />
    <title></title>
    <link rel="shortcut icon" href="IMG/favicon2.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@600&display=swap" rel="stylesheet">
    <style>
.masthead {
	position: relative;
	width: 100%;
	height: auto;
	padding: 5px 0px; /* Padding personalizado a este fichero*/
	background-image: url(../images/fondo23.png);
	background-repeat: no-repeat;
	background-size: 70%;
	background-position: center;
	font-family: 'Montserrat Alternates', sans-serif;
}
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body id="page">
    <div id="divnav" class="container px-4 px-lg-5">
        <img id="logonav" src="../images/Marcahorizontal.jpg" alt="IES GRAN CAPITÁN" />
    </div>
    <div class="container">
        <div class="masthead">
            <header class="mb-5">
                <div class="p-5 text-center" style="margin-top: 58px;">
                    <h1 class="mb-3">Tienda</h1>
                </div>
            </header>
            <h2 id='letra2' class="text-center w-100"></h2>
            <div id='divcentral' class='container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center'>
                <div class='d-flex justify-content-center'>
                    <div id='divcentral2' class='text-center'>
                        <h2>Introducir número de tarjeta</h2>
                        <form action="" method="post">
                            <label for="numeroTarjeta">Número de Tarjeta:</label>
                            <input type="text" autocomplete="off" id="numeroTarjeta" name="numeroTarjeta" autofocus required>
                            <button type="submit">Continuar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="py-2 fixed-bottom">
        <p class="text-center text-muted">Rafael Castillero | Javier Mariscal | Miguel Ángel Pintado | Juan Ranchal | Alfonso Colomino | Jaime Serrano | 2023/2024</p>
    </footer>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numeroTarjeta = $_POST['numeroTarjeta'];
    header("Location: ../view/takeawayexterior.php?numeroTarjeta=" . urlencode($numeroTarjeta));
    exit();
}
?>

</body>
</html>