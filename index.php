<?php
session_start(); // Iniciar sesión al principio del script
require '../scripts/funciones.php';

// Verificar si el usuario ha iniciado sesión
if (!haIniciadoSesion() || !esAdmin()) {
    // Si no ha iniciado sesión, redirigir al usuario a la página de inicio
    header('Location: index.html');
    exit(); // Detener el script después de la redirección
}


// Conectar a la base de datos

$conexion = conectar();
$usuarios= getUsuarios($conexion);

// Obtener categorías
$categorias = getCategoriasPorUser($conexion);

// Desconectar la base de datos
desconectar($conexion);
?>

<!---------------------------->
<!------DECLARACION HTML------>
<!---------------------------->

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="./css/Adminpanel.css"> <!-- Enlace al archivo CSS personalizado -->

<title>Admin Panel</title>
</head>

<header class="container-fluid bg-primary d-flex justify-content-center">
    <p class="text-light mb-0 p-2 fs-6">DevTB</p>
</header>

<body>

<!--------->
<!--BARRA-->
<!--------->

<?php include 'admin/menu-lateral.php'?>

<div class="container-fluid bg-warning d-flex text-center justify-content-center">
    <h1 class="text p-2 fs-6">Panel de administrador</h1>
</div>

<!--------->
<!--TABLA-->
<!--------->

<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                Bienvenido.
            </div>
            <div class="card-body">
                <h5 class="card-title">por favor, seleccione una de las opciones de la sidebar</h5>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>