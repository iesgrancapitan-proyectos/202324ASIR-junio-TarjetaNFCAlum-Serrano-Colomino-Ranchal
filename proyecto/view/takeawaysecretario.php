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

if (!isset($_SESSION['user']['email'])) {
    die("Por favor, inicie sesión con un usuario.");
}

$correo = mysqli_real_escape_string($conexion, $_SESSION['user']['email']);

$consulta = "SELECT idTarjeta FROM usuarios_tarjetas JOIN usuarios ON usuarios_tarjetas.idUsuario=usuarios.idUsuario WHERE usuarios.email='$correo';";
$result = mysqli_query($conexion, $consulta);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $idTarjeta = $row['idTarjeta'];
} else {
    die("User not found.");
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
		.verde {
			background-color: #ADFA59 !important;
		}

		.rojo {
			background-color: #F78181 !important;
		}

		@media (min-width: 300px) {

.container-sm,
.container {
	max-width: 540px;
}

#divnav {
	width: 60%;
	margin-left: 0%;

}


}

@media (min-width: 576px) {

.container-sm,
.container {
	max-width: 540px;
}

#divnav {
	width: 40%;
	margin-left: 0%;

}


}

@media (min-width: 768px) {

.container-md,
.container-sm,
.container {
	max-width: 720px;
}

#divnav {
	width: 27.5%;
	margin-left: 0%;

}


}

@media (min-width: 992px) {

.container-lg,
.container-md,
.container-sm,
.container {
	max-width: 960px;
}

#divnav {
	width: 30%;
	margin-left: auto;

}


}

@media (min-width: 1200px) {

.container-xl,
.container-lg,
.container-md,
.container-sm,
.container {
	max-width: 1140px;
}

#divnav {
	width: 25%;
	margin-left: auto;

}

}

@media (min-width: 1400px) {

.container-xxl,
.container-xl,
.container-lg,
.container-md,
.container-sm,
.container {
	max-width: 1320px;
}

#divnav {
	width: 20%;
	margin-left: auto;

}

}



.masthead {
	position: relative;
	width: 100%;
	height: auto;
	padding: 5px 0px;
	/*min-height: 15rem;*/
	background-image: url(fondo23.png);
	background-repeat: no-repeat;
	background-size: 70%;
	background-position: center;
	font-family: 'Montserrat Alternates', sans-serif;
}


#letra {
color: #0772B9;
}

#letra2 {
color: #3B3B3A;
}

#logonav {
width: 100%;
height: auto;
background-image: url(Marcahorizontal.jpg);
z-index: -1;
position: relative;
}


#divcentral2 {
margin-bottom: 35%;
}

.container-btn-mode {
position: absolute;
top: 20px;
right: 30px;
cursor: pointer;
z-index: 2;
font-size: 0;
}

.btn-mode {
display: inline-block;
width: 50px;
height: 30px;
border: 2px solid black;
transition: background-color .5s;
}

.btn-mode i {
display: block;
font-size: 17px;
text-align: center;
line-height: 30px;
}

.active {
background-color: black;
color: #ffcd5c !important;
}

.dark-mode {
background-color: #0e0e0e;
transition: background-color .5s;
}

.dark-mode .card {
background-color: #1A1C1E;
}

.dark-mode h1,
.dark-mode h2,
.dark-mode .btn-contact {
color: white;
}

.dark-mode .btn-mode {
background-color: #1A1C1E;
border: 1px solid white;
color: white;
}

.verde {
background-color: #ADFA59;
}

.rojo {
background-color: #F78181;
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



<!-- En el controlador se puede definir una clase $this->estaOcupado = ... para recibirla en la vista de la siguiente forma: -->
<!-- class=" bg-primary " -->
<header id='medio' >
                <div id='divcentral' class='container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center'>
                    <div class='d-flex justify-content-center'>
                        <div id='divcentral2' class='text-center'>
                            <h2 id='letra2' class='mx-auto mt-2 mb-5 letradedia'>Elija una opción</h2>
                            <h5 id='letra2' class='mx-auto mt-2 mb-5 letradedia'>Eres el usuario  <?php echo $_SESSION['user']['email'];?> </h5>
                            <a class='btn btn-primary' href='manualcodigo.php'>Creacion de codigo de barras</a>
                            <a class='btn btn-primary' href='recarga.php'>Recarga</a>
                            <a class='btn btn-primary' href='takeawaykiosko.php'>Carro</a>
                            <a class='btn btn-primary' href='../index.php'>Inicio</a>
                        </div>
                    </div>
                </div>
</header>
            </div>
        </div>
        <footer class="py-2 fixed-bottom">
            <p class="text-center text-muted">Rafael Castillero | Javier Mariscal | Miguel Ángel Pintado | Juan Ranchal | Alfonso Colomino | Jaime Serrano | 2023/2024</p>
        </footer>
        
            </body>
</html>
