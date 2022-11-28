<?php
    require '../config/database.php';
    require '../config/config1.php';
    require '../clases/cliente_funciones.php';
    
    $db = new Conexion();
    $con = $db->pdo;

    $error = [];

    if (!empty($_POST)) {
        
        $nombre = trim($_POST['nombre']);
        $apellido = trim($_POST['apellido']);
        $email = trim($_POST['email']);
        $dni = trim($_POST['dni']);
        $usuario = trim($_POST['usuario']);
        $telefono = trim($_POST['telefono']);
        $password = trim($_POST['password']);
        $repassword = trim($_POST['repassword']);
        $id = registrarCliente([$nombre, $apellido, $email, $telefono, $dni], $con);
        if ($id>0) {
            $pass_hash = password_hash($password, PASSWORD_DEFAULT);
            $token = generarToken();
            if (registrarUsuario([$usuario, $password, $token, $id], $con)) {
                $errs[] = "Error al registrar usuario";
            }
        }else{
            $errs[] = "Error al registrar cliente";
        }
        if(count($errs)==0){

        }else{
            print_r($errs);
        }
    }

?>

<?php include "../layouts/head.php"; ?>

<body>
<?php include "../layouts/navbar.php"; ?>
<br>
<main>
    <div class="container">
        <h2>Datos del cliente</h2>
        <form class="row g-3" action="registro.php" method="post" autocomplete="off">
            <div class="col-md-6">
                <label for="nombre"><span class="text-danger">*</span>Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label for="apellido"><span class="text-danger">*</span>Apellido</label>
                <input type="text" name="apellido" id="apellido" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label for="email"><span class="text-danger">*</span>Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label for="telefono"><span class="text-danger">*</span>Teléfono</label>
                <input type="tel" name="telefono" id="telefono" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label for="dni"><span class="text-danger">*</span>DNI</label>
                <input type="text" name="dni" id="dni" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label for="usuario"><span class="text-danger">*</span>Usuario</label>
                <input type="text" name="usuario" id="usuario" class="form-control" required>
            </div>
                
            <div class="col-md-6">
                <label for="password"><span class="text-danger">*</span>Contraseña</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label for="repassword"><span class="text-danger">*</span>Repetir contraseña</label>
                <input type="password" name="repassword" id="repassword" class="form-control" required>
            </div>
            <i><b>Nota: </b> Los campos con (*) son obligatorios</i>
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Registrar</button>
            </div>           
        </form>
    </div>


  <!-- FOOTER -->
    
</main>
    <?php include '../layouts/footer.php'; ?>
</body>
</html>