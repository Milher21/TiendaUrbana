<?php

	function generarToken(){
		return md5(uniqid(mt_rand()), false);
	}

	function registrarCliente(array $datos, $con){
		$sql = $con->prepare("INSERT INTO clientes (nombre, apellido, email, telefono, dni, status, fecha_alta) VALUES (?,?,?,?,?,1,now())");
		if ($sql->execute($datos)) {
			return $con->lastInsertId();
		}
		return 0;
	}

	function registrarUsuario(array $datos, $con){
		$sql = $con->prepare("INSERT INTO usuarios (usuario, password, token, id_cliente) VALUES (?,?,?,?)");
		if ($sql->execute($datos)) {
			return true;
		}
		return false;
	}

?>