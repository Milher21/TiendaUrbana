<?php
session_start();
$num_cart=0;
if(isset($_SESSION['carrito']['producto'])){
    $num_cart= count($_SESSION['carrito']['producto']);
}

?>