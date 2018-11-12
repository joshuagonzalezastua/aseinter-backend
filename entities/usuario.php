<?php
class Usuario {
	
    private $conn;
    private $table_name = "usuario";
  
    public $correo;
    public $nombre;
    public $apellidos;
    public $contrasena;
    public $privilegio;
 
    public function __construct($db){
        $this->conn = $db;
    }
   
	function read(){
    	$query = "SELECT correo, nombre, apellidos, contrasena, privilegio FROM ". $this->table_name;
        $stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
    }
    
    function readOne() {
        $query = "SELECT correo, nombre, apellidos, contrasena, privilegio 
        FROM " . $this->table_name . " WHERE correo = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->correo);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->correo = $row['correo'];
        $this->nombre = $row['nombre'];
        $this->apellidos = $row['apellidos'];
        $this->telefono = $row['telefono'];
        $this->contrasena = $row['contrasena'];
        $this->privilegio = $row['privilegio'];
    }

    function login() {
        $query = "SELECT correo, nombre, apellidos, contrasena, privilegio 
        FROM " . $this->table_name . " WHERE correo = ? and contrasena = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->correo);
        $stmt->bindParam(2, $this->contrasena);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->correo = $row['correo'];
        $this->nombre = $row['nombre'];
        $this->apellidos = $row['apellidos'];
        $this->contrasena = $row['contrasena'];
        $this->privilegio = $row['privilegio'];
    }

    function create() {
        $query = "INSERT INTO " . $this->table_name 
            . " SET
            correo=:correo, 
            nombre=:nombre, 
            apellidos=:apellidos,
            contrasena=:contrasena, 
            privilegio=:privilegio";

        $stmt = $this->conn->prepare($query);

        $this->correo=htmlspecialchars(strip_tags($this->correo));
        $this->nombre=htmlspecialchars(strip_tags($this->nombre));
        $this->apellidos=htmlspecialchars(strip_tags($this->apellidos));
        $this->contrasena=htmlspecialchars(strip_tags($this->contrasena));
        $this->privilegio=htmlspecialchars(strip_tags($this->privilegio));

        $stmt->bindParam(":correo", $this->correo);
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":apellidos", $this->apellidos);
        $stmt->bindParam(":contrasena", $this->contrasena);
        $stmt->bindParam(":privilegio", $this->privilegio);

        if($stmt->execute()){
            return true;
        }

        return false;
    }
	
	function createUser() {
        $query = "INSERT INTO " . $this->table_name 
            . " SET
            correo=:correo, 
            nombre=:nombre, 
            apellidos=:apellidos,
            contrasena=:contrasena, 
            privilegio=:privilegio";

        $stmt = $this->conn->prepare($query);

        $this->correo=htmlspecialchars(strip_tags($this->correo));
        $this->nombre=htmlspecialchars(strip_tags($this->nombre));
        $this->apellidos=htmlspecialchars(strip_tags($this->apellidos));
        $this->contrasena=htmlspecialchars(strip_tags($this->contrasena));
        $this->privilegio=htmlspecialchars(strip_tags($this->privilegio));

        $stmt->bindParam(":correo", $this->correo);
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":apellidos", $this->apellidos);
        $stmt->bindParam(":contrasena", $this->contrasena);
        $stmt->bindParam(":privilegio", "USUARIO");

        if($stmt->execute()){
            return true;
        }

        return false;
    }

    function update() {
        $query = "UPDATE " . $this->table_name . " SET
            nombre=:nombre, 
            apellidos=:apellidos
            WHERE 
            correo=:correo";

        $stmt = $this->conn->prepare($query);

        $this->correo=htmlspecialchars(strip_tags($this->correo));
        $this->nombre=htmlspecialchars(strip_tags($this->nombre));
        $this->apellidos=htmlspecialchars(strip_tags($this->apellidos));
    
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":apellidos", $this->apellidos);
        $stmt->bindParam(":correo", $this->correo);
    
        if($stmt->execute()){
            return true;
        }

        return false;
    }
}
?>