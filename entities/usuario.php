<?php
class Usuario {
	
    private $conn;
    private $table_name = "usuario";
  
    public $nombre_usuario;
    public $contrasena;
 
    public function __construct($db){
        $this->conn = $db;
    }
   
	function read(){
    	$query = "SELECT nombre_usuario, contrasena FROM ". $this->table_name;
        $stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
    }
    
    function readOne() {
        $query = "SELECT nombre_usuario, contrasena
        FROM " . $this->table_name . " WHERE nombre_usuario = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->nombre_usuario);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->nombre_usuario = $row['nombre_usuario'];
        $this->contrasena = $row['contrasena'];
    }

    function login() {
        $query = "SELECT nombre_usuario, contrasena 
        FROM " . $this->table_name . " WHERE nombre_usuario = ? and contrasena = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->nombre_usuario);
        $stmt->bindParam(2, $this->contrasena);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->nombre = $row['nombre_usuario'];
        $this->contrasena = $row['contrasena'];
    }

    function create() {
        $query = "INSERT INTO " . $this->table_name 
            . " SET
            nombre_usuario=:nombre_usuario,
            contrasena=:contrasena";

        $stmt = $this->conn->prepare($query);

        $this->nombre_usuario=htmlspecialchars(strip_tags($this->nombre_usuario));
        $this->contrasena=htmlspecialchars(strip_tags($this->contrasena));

        $stmt->bindParam(":nombre_usuario", $this->nombre_usuario);
        $stmt->bindParam(":contrasena", $this->contrasena);

        if($stmt->execute()){
            return true;
        }

        return false;
    }

    function update() {
        $query = "UPDATE " . $this->table_name . " SET 
            contrasena=:contrasena
            WHERE 
            nombre_usuario=:nombre_usuario";

        $stmt = $this->conn->prepare($query);

        $this->contrasena=htmlspecialchars(strip_tags($this->contrasena));
    
        $stmt->bindParam(":contrasena", $this->contrasena);
        $stmt->bindParam(":nombre_usuario", $this->nombre_usuario);
    
        if($stmt->execute()){
            return true;
        }

        return false;
    }
}
?>