<?php
session_start(); // Iniciar sesión al principio del script
require './scripts/funciones.php';

// Verificar si el usuario ha iniciado sesión
if (!haIniciadoSesion()) {
    // Si no ha iniciado sesión, redirigir al usuario a la página de inicio
    header('Location: index.html');
    exit(); // Detener el script después de la redirección
}

// Conectar a la base de datos
$conexion = conectar();

// Obtener categorías
$categorias = getCategoriasPorUser($conexion);

// Desconectar la base de datos
desconectar($conexion);
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./css/main.css">
    <title>Panel de usuario</title>
  </head>
  <body>
    <header class="container-fluid bg-primary d-flex justify-content-center">
      <p class="text-light mb-0 p-2 fs-6 ">Bienvenido, <?= $_SESSION['usuario']?></p>
    </header>


    <!------------------------->
    <!-- Barra de navegacion -->
    <!------------------------->

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="panelUsuario.php">Inicio <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="scripts/cerrar-sesion.php">Cerrar sesión</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="FAQ.php">FAQ´s</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">#</a>
      </li>
    </ul>
  </div>
</nav>

    <!---------------->
    <!-- CATEGORIAS -->
    <!---------------->

    <div class="container-fluid d-flex justify-content-center align-items-center" style="height: 80vh;">
      <div class="row">
        <div class="col-lg-14 bg-light p-4 rounded">

          <?php foreach($categorias as $fila): ?>
              <h4><a href="categorias/<?php echo $fila[2] ?>"><?php echo $fila[0] ?></a></h4>
              <p><?php echo $fila[1] ?>.</p>
          <?php endforeach; ?>

        </div>
      </div>
    </div>

    <!--------------------->
    <!-- PIE DE LA PAGINA-->
    <!--------------------->

    <footer class="w-100 d-flex align-items justify-content-center flex-wrap">
      <p class="fs-5 px-3 pt-3">DevTB © Todos los derechos reservados 2024</p>
      <div id="iconos">
        <a href="#"><i class="bi bi-facebook"></i></a>
        <a href="#"><i class="bi bi-twitter-x"></i></a>
        <a href="#"><i class="bi bi-instagram"></i></a>
      </div>
    </footer>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script>src="main.js"</script>

  </body>
</html>
