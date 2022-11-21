<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <title>LOGIN</title>
	<script src="../js/login.js"></script>
</head>
<?php
session_start();
if(!empty($_SESSION['tipo_usuario'])){
    header('Location: ../controlador/LoginController.php');
}
else{
    session_destroy();
?>


<body>
<div class="container" id="container">
	<div class="form-container sign-up-container">
		<form action="../Modelo/Agregar_usuario.php" method="POST">
			<h1>Crear Cuenta</h1>
			<input name="nombre_us" type="text" placeholder="Nombre" />
			<input name="correo_us" type="email" placeholder="Correo" />
			<input name="contraseña_us" type="password" placeholder="Contraseña" />
			<input name="dni_us" type="text" maxlength="8" placeholder="Dni" />
			<input name="telf_us" type="text" placeholder="Telefono" />
			<input name="direc_us" type="text" placeholder="Dirección" />
			<button>Registrarse</button>
		</form>
	</div>
	<div class="form-container sign-in-container">
		<form action="../controlador/LoginController.php" method="POST">
			<h1>Iniciar sesión</h1>
			<input type="email" name="email" placeholder="Email" />
			<input type="password" name="password" placeholder="Password" />
			<a href="#">¿Has olvidado tu contraseña?</a>
			<button>Iniciar sesión</button>
		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<h1>¡Bienvenido!</h1>
				<p>Para mantenerse conectado con nosotros, inicie sesión con su información personal</p>
				<button class="ghost" id="signIn">Iniciar sesión</button>
			</div>
			<div class="overlay-panel overlay-right">
				<h1>Bienvenido!</h1>
				<p>Introduzca sus datos personales</p>
				<button class="ghost" id="signUp">Crear Cuenta</button>
			</div>
		</div>
	</div>
</div>

<footer>
	<p>
		Created with <i class="fa fa-heart"></i> by
		<a target="_blank" href="https://florin-pop.com">Florin Pop</a>
		- Read how I created this and how you can join the challenge
		<a target="_blank" href="https://www.florin-pop.com/blog/2019/03/double-slider-sign-in-up-form/">here</a>.
	</p>
</footer>


<script src="../js/jquery-3.6.1.min.js"></script>
<script>
const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
container.classList.remove("right-panel-active");
});</script>

</body>
</html>
<?php
}
?>