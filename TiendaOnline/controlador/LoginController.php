<?php
include '../Modelo/Usuario.php';
session_start();
$correo = $_POST['email'];
$pass = $_POST['password'];
$usuario =new Usuario();

if(!empty($_SESSION['tipo_usuario'])){
    
    switch ($_SESSION['tipo_usuario']) {
        case 1:
            header('Location: ../Vistas/admin.php');
            break;
        case 2:
            header('Location: ../index.php');
            break;
    }
}
else{
    $usuario->Loguearse($correo,$pass);
    if (!empty($usuario->objetos)) {
        foreach ($usuario->objetos as $objeto) {
           $_SESSION['usuario']=$objeto->id_usuario;
           $_SESSION['tipo_usuario']=$objeto->tipo_usuario;
           $_SESSION['nombre_usuario']=$objeto->nombre_usuario;
        }
        switch ($_SESSION['tipo_usuario']) {
            case 1:
                header('Location: ../Vistas/admin.php');
                break;
            case 2:
                header('Location: ../index.php');
                break;
        }
    }
    else{
        header('Location: ../Vistas/Login.php');
    }
}

?>