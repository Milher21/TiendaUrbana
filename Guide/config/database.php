<?php 
    class Conexion{
        Private $servidor="Localhost";
        Private $db="tienda";
        Private $puerto= 3307;
        Private $charset="utf8mb4";
        Private $usuario="root";
        Private $contrasena="12MSarifer";
        public $pdo=null;
        private $atributos=[PDO::ATTR_CASE=> PDO::CASE_LOWER,PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,PDO::ATTR_ORACLE_NULLS=>PDO::NULL_EMPTY_STRING,PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_OBJ,PDO::ATTR_EMULATE_PREPARES => false];
        
        function __construct(){
            try {
                $this->pdo= new PDO("mysql:dbname={$this->db};host={$this->servidor};port={$this->puerto};charset={$this->charset}",$this->usuario,$this->contrasena,$this->atributos);        
            } catch (PDOException $e) {
                echo 'Error conexion: '. $e->getMessage();
                exit();
            }
        }
    }
?>