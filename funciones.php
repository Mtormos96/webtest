<?php
// --CONECTAR BBDD-- //

function conectar()
{
    $conexion = mysqli_connect('localhost', 'root', '', 'intranet');

    if (!$conexion) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    return $conexion;
}

// --CATEGORIAS-- //

function getTodasCategorias($conexion)
{
    $respuesta = mysqli_query($conexion, "SELECT * FROM categorias");

    if (!$respuesta) {
        die("Error en la consulta: " . mysqli_error($conexion));
    }

    return $respuesta->fetch_all();
}

function getCategoriasPorUser($conexion)
{
    // Iniciar sesión solo si no está activa
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : '';
    $consulta = "SELECT C.categoria, C.descripcion, C.ruta FROM `permisos` P INNER JOIN categorias C ON P.ID_Categoria = C.ID_Categoria WHERE usuario='$usuario'";
    $respuesta = mysqli_query($conexion, $consulta);

    return $respuesta->fetch_all();
}

function getCategoriaPorId($id){
        global $conexion;
        $respuesta = mysqli_query($conexion, "SELECT * FROM categorias WHERE ID_Categoria =  ".$id);        
        return mysqli_fetch_row($respuesta);
    }



// -COMPROBAR QUE CATEGORIAS TIENE UN USUARIO-- //

function tienePermiso($usuario, $idCat){
    global $conexion;
    $respuesta= mysqli_query($conexion, "SELECT 1 FROM permisos WHERE usuario='".$usuario."' AND ID_Categoria=".$idCat);
    if($fila=mysqli_fetch_row($respuesta))
    return True;
}


// --MODIFICAR CATEGORIAS-- //

function editarCategoria($id, $nombre, $descripcion, $ruta){
        global $conexion;
        mysqli_query($conexion, "UPDATE categorias SET categoria='".$nombre."', descripcion='".$descripcion."', ruta='".$ruta."' WHERE ID_Categoria = ".$id);
    }

function eliminarPermisos($usuario){
    global $conexion;
    mysqli_query($conexion, "DELETE FROM permisos WHERE usuario='".$usuario."'");
}

function asignarPermisos($usuario, $idCat){
    global $conexion;
    mysqli_query($conexion, "INSERT INTO permisos VALUES ('".$usuario."',".$idCat.")");
}

// --USUARIOS-- //

function getUsuarios($conexion)
{
    // Iniciar sesión solo si no está activa
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $respuesta=mysqli_query($conexion,"SELECT * FROM usuarios WHERE admin<>1");
    return $respuesta->fetch_all();
}

// --VALIDAR USUARIOS-- //

function validarLogin($usuario, $clave)
{
    $conexion = conectar();
    $consulta ="SELECT * FROM usuarios WHERE usuario='$usuario' AND clave='$clave'";
    $respuesta = mysqli_query($conexion, $consulta);

    if ($fila = mysqli_fetch_row($respuesta)) {
        session_start();
        $_SESSION['usuario'] = $usuario;
        $_SESSION['admin'] = $fila[2];
        mysqli_close($conexion); // Cerrar conexión después de usarla
        return true;
    }

    mysqli_close($conexion); // Cerrar conexión si no se inicia sesión
    return false;
}

function haIniciadoSesion()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    return isset($_SESSION['usuario']);
}

function esAdmin()
{
    return $_SESSION['admin'];
}

// --DESCONECTAR BBDD-- //

function desconectar($conexion)
{
    mysqli_close($conexion);
}

// Obtener categorías solo si ha iniciado sesión
if (haIniciadoSesion()) {
    $conexion = conectar();
    $categorias = getCategoriasPorUser($conexion);
    $usuarios = getUsuarios($conexion); // Corregido aquí
    desconectar($conexion);
}
?>