<?php
include_once 'Conexion.php';
//include '../config/config.php';
class Usuario{
    var $objetos;
    var $productos;
   
    public function __construct(){
        $db = new Conexion();
        $this->acceso = $db->pdo;

    }
    function Loguearse($Correo,$pass){
        $sql="SELECT * FROM usuario inner join tipo_us on Tipo_usuario=id_tipo_us where correo=:correo and contraseña=:pass";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':correo' => $Correo,':pass'=>$pass));
        $this->objetos = $query->fetchAll();
        return $this->objetos;
       
    }
    function Crear_usuario($nombre,$correo,$contra,$dni,$telf,$direccion,$tipo){
        $sql="INSERT INTO usuario(id_usuario,nombre_usuario,correo,contraseña,dni,telefono, direccion,Tipo_usuario) VALUES (null,:nombre,:correo,:contra,:dni,:telf,:direccion,:tipo)";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':nombre'=>$nombre,':correo'=>$correo,':contra'=>$contra,':dni'=>$dni,':telf'=>$telf,':direccion'=>$direccion,':tipo'=>$tipo));
        if ($query->execute()) {
            header('Location: ../Vistas/Login.php');
        } else {
            header('Location: ../Vistas/Login.php');
        }
    }
   function Listar_productos(){
    $sql="SELECT id_producto,nombre_producto,precio,imagen_producto FROM  productos where mostrar=1";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->productos = $query->fetchAll(PDO::FETCH_ASSOC);
        return $this->productos;
   }
    
   function Listar_Zapatillas(){
    $sql="SELECT id_producto,nombre_producto,precio,imagen_producto FROM  productos where categoria=1 &&  activo=1" ;
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->zapatillas = $query->fetchAll(PDO::FETCH_ASSOC);
        return $this->zapatillas;
   }

   //----------
   function Listar_Jeans(){
    $sql="SELECT id_producto,nombre_producto,precio,imagen_producto FROM  productos where categoria=2 &&  activo=1" ;
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->jeans = $query->fetchAll(PDO::FETCH_ASSOC);
        return $this->jeans;
   }
//------------
function Listar_Polos(){
    $sql="SELECT id_producto,nombre_producto,precio,imagen_producto FROM  productos where categoria=3 &&  activo=1" ;
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->polos = $query->fetchAll(PDO::FETCH_ASSOC);
        return $this->polos;
   }

   function Listar_Casacas(){
    $sql="SELECT id_producto,nombre_producto,precio,imagen_producto FROM  productos where categoria=4 &&  activo=1" ;
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->casacas = $query->fetchAll(PDO::FETCH_ASSOC);
        return $this->casacas;
   }

   function Listar_producto(){
    $sql="SELECT id_producto,nombre_producto,precio,imagen_producto FROM  productos where categoria=1 &&  activo=1" ;
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->producto = $query->fetchAll(PDO::FETCH_ASSOC);
        return $this->producto;
   }

   function detalles($id){
    $sql="SELECT id_producto,nombre_producto,detalle,precio,imagen_producto,talla FROM  productos where  id_producto=:id && activo=1" ;
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => $id));
        $this->detalle= $query->fetchAll(PDO::FETCH_ASSOC);
        return $this->detalle;
   }



   /*function mostrar($clave){

    $sql="SELECT id_producto,nombre_producto,detalle,precio,imagen_producto,talla FROM  productos where  id_producto=:id && activo=1" ;
        $query = $this->acceso->prepare("SELECT nombre, precio, cantidad,  FROM  productos where  id_producto=? and activo=1");
        $query->execute(array(':id' => $clave));
        $this->producto= $query->fetchAll(PDO::FETCH_ASSOC);
      // return $this->$producto 
   }*/

   

}
?>