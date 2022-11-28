<?php 

	define("CLIENT_ID", "AUrzZ3_-ohWTf6GQNoJJM5V_ssU-T-MvIGzX-IeS5ySX9Ld0xqo6S--k-9nVyTbq7R0fwbisLCi5_BhA");
	define("CURRENCY", "USD");
	define("KEY_TOKEN", "APR.wew-421*");
	define("MONEDA", "S/");


	session_start();
	$usuario='Inicia Sesión';
	if(isset($_SESSION['nombre'])){
    	$usuario = $_SESSION['nombre']; 
	}
	
	$num_cart=0;
	
	if(isset($_SESSION['carrito']['productos'])){
    	$num_cart = count($_SESSION['carrito']['productos']);
	}
?>