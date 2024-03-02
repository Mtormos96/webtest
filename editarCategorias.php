<?php
session_start(); // Iniciar sesión al principio del script
require '../scripts/funciones.php';

// Verificar si el usuario ha iniciado sesión
if (!haIniciadoSesion() || !esAdmin()) {
    // Si no ha iniciado sesión, redirigir al usuario a la página de inicio
    header('Location: index.html');
    exit(); // Detener el script después de la redirección
}

if (isset($_GET['usuario']))
    $usuario = $_GET['usuario'];
//else header('Location: ../panelAdmin.php');

// Conectar a la base de datos
$conexion = conectar();

// Obtener las categorias
$categorias = getTodasCategorias($conexion);

// Verificar si se ha obtenido al menos una categoría
if (!empty($categorias)) {
    // Obtener la primera categoría del array (o cualquier otra lógica que desees)
    $categoria = $categorias[0];
} else {
    // Si no hay categorías, puedes asignar un array vacío a $categoria o manejarlo de otra manera
    $categoria = [];
}

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
<link rel="stylesheet" href="../css/Adminpanel.css"> <!-- Enlace al archivo CSS personalizado -->

<title>Admin Panel</title>
</head>

<header class="container-fluid bg-primary d-flex justify-content-center">
    <p class="text-light mb-0 p-2 fs-6">Panel de administración</p>

<!------------------------------->
<!------FORMULARIO PERMISOS------>
<!------------------------------->



</header>

<body>

<!--------->
<!--BARRA-->
<!--------->

<?php include 'menu-lateral.php'?>

<div class="container-fluid bg-warning d-flex text-center justify-content-center">
    <h1 class="text-dark p-2 fs-6">Editar categoria</h1>
</div>

<!--------->
<!--TABLA-->
<!--------->

    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3 justify-content-center">
                <!-- TABLA DE USUARIOS -->
                <div class="table-container">
                    <p>En esta sección podras modificar los permisos para los usuarios de la BBDD.</p>
                </div>
            </div>
            <div class="col-md-4">
                <!-- FORMULARIO DE PERMISOS -->
            <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
            
            <div class="panel panel-default">
              <div class="panel-heading"><h3 class="panel-title">Edición de permisos</h3></div>
              <div class="panel-body">
                <form action="../scripts/editar-categoria.php" method="POST">
                  <div class="form-group">
                    <label for="txtId">ID Categoría</label>
                    <input type="number" class="form-control" id="txtId" name="txtId" value="<?= $categoria[0] ?>" readonly>
                  </div>                
                  <div class="form-group">
                    <label for="txtNombre">Nombre</label>
                    <input type="text" class="form-control" id="txtNombre"  name="txtNombre" value="<?= $categoria[1] ?>">
                  </div>
                  <div class="form-group">
                    <label for="txtDescripcion">Descripción</label>
                    <input type="text" class="form-control" id="txtDescripcion" name="txtDescripcion" value="<?= $categoria[2] ?>">
                  </div>
                  <div class="form-group">
                    <label for="txtRuta">Ruta</label>
                    <input type="text" class="form-control" id="txtRuta" name="txtRuta" value="<?= $categoria[3] ?>">
                  </div>                  
                  <button type="submit" class="btn btn-default">Guardar</button>
                </form>
              </div>
            </div>
        </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
