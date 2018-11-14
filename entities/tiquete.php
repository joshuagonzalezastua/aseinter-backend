<?php
class Tiquete {
	
    private $conn;
    private $table_name = "tiquete";
  
    public $id_tiquete;
    public $id_persona;
    public $fecha;
    public $motivo;
 
    public function __construct($db){
        $this->conn = $db;
    }
   
	function read() {
    	$query = "SELECT id_tiquete, id_persona, fecha, motivo FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
    }
    
    function readOne() {
        $query = "SELECT id_tiquete, id_persona, fecha, motivo
        FROM " . $this->table_name . " WHERE id_tiquete = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_actividad);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->id_tiquete = $row['id_tiquete'];
        $this->id_persona = $row['id_persona'];
        $this->fecha = $row['fecha'];
        $this->motivo = $row['motivo'];
    }

    function create() {
        $query = "INSERT INTO " . $this->table_name 
            . " SET 
            id_persona=:id_persona,
            fecha=:fecha, 
            motivo=:motivo";

        $stmt = $this->conn->prepare($query);

        $this->id_persona = htmlspecialchars(strip_tags($this->id_persona));
        $this->motivo = htmlspecialchars(strip_tags($this->motivo));
        $this->fecha = htmlspecialchars(strip_tags($this->fecha));

        $stmt->bindParam(":id_persona", $this->id_persona);
        $stmt->bindParam(":motivo", $this->motivo);
        $stmt->bindParam(":fecha", $this->fecha);

        if($stmt->execute()) {
            return true;
        }

        return false;
    }

    function update() {
        $query = "UPDATE " . $this->table_name 
        . " SET 
        id_persona=:id_persona,
        motivo=:motivo,
        fecha=:fecha 
        WHERE 
        id_tiquete=:id_tiquete";

        $stmt = $this->conn->prepare($query);

        $this->correo=htmlspecialchars(strip_tags($this->correo));
        $this->motivo=htmlspecialchars(strip_tags($this->motivo));
        $this->fecha=htmlspecialchars(strip_tags($this->fecha));
    
        $stmt->bindParam(":id_persona", $this->id_persona);
        $stmt->bindParam(":motivo", $this->motivo);
        $stmt->bindParam(":fecha", $this->fecha);
        $stmt->bindParam(":id_tiquete", $this->id_tiquete);
    
        if($stmt->execute()){
            return true;
        }

        return false;
    }

    function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_tiquete = ?";
        $stmt = $this->conn->prepare($query);
        $this->id_tiquete=htmlspecialchars(strip_tags($this->id_tiquete));
        $stmt->bindParam(1, $this->id_tiquete);

        if($stmt->execute()){
            return true;
        }

        return false;
    }
}
?>