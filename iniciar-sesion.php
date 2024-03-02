<?php
    require 'funciones.php';
    $usuario = $_POST['txtUsuario'];
    $clave = $_POST['txtClave'];
    $conexion = conectar(); // Establecer conexión y asignarla a una variable
    if (validarLogin($usuario, $clave)) {
        // Accedemos al panel de usuario
        desconectar($conexion); // Desconectar la base de datos
        header('Location: ../panelUsuario.php');
                if( esAdmin())
        			header('Location: ../panelAdmin.php');
        exit(); // Detener el script después de la redirección
    } else {
        // Volvemos al formulario inicial
?>
        <script>
            alert('Los datos ingresados son incorrectos, ')
            location.href = "../index.html"; // Corrección en la redirección
        </script>

<?php
        desconectar($conexion); // Desconectar la base de datos
    }
?>