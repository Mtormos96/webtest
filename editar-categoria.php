<?php
session_start(); // Iniciar sesión al principio del script
require './funciones.php';

// Verificar si el usuario ha iniciado sesión
if (!haIniciadoSesion() || !esAdmin()) {
    // Si no ha iniciado sesión, redirigir al usuario a la página de inicio
    header('Location: ../index.html');
    exit(); // Detener el script después de la redirección
}

  // Verificación del parámetro POST:
  if( isset($_POST['txtId']) && isset($_POST['txtNombre']) 
    && isset($_POST['txtDescripcion']) && isset($_POST['txtRuta']) )
  {
    $id = $_POST['txtId'];
    $nombre = $_POST['txtNombre'];
    $descripcion = $_POST['txtDescripcion'];
    $ruta = $_POST['txtRuta'];
  }
  else header('Location: ../admin/index.php');

// Conectar a la base de datos //

$conexion = conectar();

editarCategoria( $id, $nombre, $descripcion, $ruta );

// Desconectar la base de datos
desconectar($conexion);

header('Location: ../admin/editarCategorias.php?id='.$id);

?>