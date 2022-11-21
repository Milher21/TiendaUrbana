<?php
include_once 'Usuario.php';
$nombre=$_POST['nombre_us'];
$correo=$_POST['correo_us'];
$contra=$_POST['contraseña_us'];
$dni=$_POST['dni_us'];
$telf=$_POST['telf_us'];
$direccion=$_POST['direc_us'];
$tipo=2;
$crear_usuario =new Usuario();
$crear_usuario->Crear_usuario($nombre,$correo,$contra,$dni,$telf,$direccion,$tipo);

?>