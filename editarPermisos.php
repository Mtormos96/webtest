<?php
session_start(); // Iniciar sesión al principio del script
require '../scripts/funciones.php';


// Verificar si el usuario ha iniciado sesión
if (!haIniciadoSesion() || !esAdmin()) {
    // Si no ha iniciado sesión, redirigir al usuario a la página de inicio
    header('Location: index.html');
    exit(); // Detener el script después de la redirección
}

if(isset($_GET['usuario']))
    $usuario = $_GET['usuario'];
else header('Location: ../panelAdmin.php');

// Conectar a la base de datos

$conexion = conectar();

// Obtener las categorias
$categorias = getTodasCategorias($conexion);

// Desconectar la base de datos

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
    <h1 class="text-dark p-2 fs-6">Editar permisos</h1>
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
                <div class="card">
                    <div class="card-body">
                        <form action="../scripts/actualizarPermisos.php" method="POST">
                            <div class="mb-3">
                            <legend class="bg-primary text-light card-body text-center">Panel de edición</legend>
                                <div class="mb-3">
                                  <label for="disabledTextInput" class="form-label text-bold">Usuario</label>
                                    <input type="text" class="form-control" name="txtUsuario" id="txtUsuario" value="<?= $usuario ?>" readonly>
                                </div>
                                <div class="mb-3">
                                    <?php foreach ($categorias as $categoria): ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox"  name="categoria_<?php echo $categoria[0] ?>" id="categoria_<?php echo $categoria[0] ?>" <?php if(tienePermiso($usuario, $categoria[0])) echo "checked" ?> >
                                            <label class="form-check-label" for="categoria_<?php echo $categoria[0] ?> ">
                                                <?php echo $categoria[1]; ?>
                                            </label>
                                        </div>
                                    <?php endforeach;
                                    desconectar($conexion); ?>
                                </div>
                                    <!-- Otras entradas del formulario -->
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>