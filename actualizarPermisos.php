<?php
session_start(); // Iniciar sesión al principio del script
require './funciones.php';

// Verificar si el usuario ha iniciado sesión
if (!haIniciadoSesion() || !esAdmin()) {
    // Si no ha iniciado sesión, redirigir al usuario a la página de inicio
    header('Location: index.html');
    exit(); // Detener el script después de la redirección
}

if(isset($_POST['txtUsuario']))
    $usuario = $_POST['txtUsuario'];
else header('Location: ../panelAdmin.php');

// Conectar a la base de datos //

$conexion = conectar();


// Eliminar permisos //

eliminarPermisos($usuario);
$categorias= getTodasCategorias($conexion);

// Actualizar permisos según checkbox marcados //

foreach($categorias as $categoria) {
    if (isset($_POST['categoria_' . $categoria[0]])) { // Corrección en la verificación del isset y en el índice del $_POST
        asignarPermisos($usuario, $categoria[0]);
    }
}

// Desconectar la base de datos
desconectar($conexion);

header('Location: ../admin/permisos.php');

?>



