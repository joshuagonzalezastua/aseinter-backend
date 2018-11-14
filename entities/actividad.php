<?php
class Actividad {
	
    private $conn;
    private $table_name = "actividad";
  
    public $id_actividad;
    public $titulo;
    public $descripcion;
    public $color;
    public $startDate;
    public $endDate;
 
    public function __construct($db){
        $this->conn = $db;
    }
   
	function read() {
    	$query = "SELECT id_actividad, titulo, descripcion, color, startDate, endDate FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
    }
    
    function readOne() {
        $query = "SELECT id_actividad, titulo, descripcion, fecha
        FROM " . $this->table_name . " WHERE id_actividad = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_actividad);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->id_actividad = $row['id_actividad'];
        $this->titulo = $row['titulo'];
        $this->descripcion = $row['descripcion'];
        $this->fecha = $row['fecha'];
    }

    function create() {
        $query = "INSERT INTO " . $this->table_name
            . " SET 
            titulo=:titulo,
            descripcion=:descripcion,
            color=:color,
            startDate=:startDate,
            endDate=:endDate";

        $stmt = $this->conn->prepare($query);

        $this->titulo = htmlspecialchars(strip_tags($this->titulo));
        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
        $this->color = htmlspecialchars(strip_tags($this->color));
        $this->startDate = htmlspecialchars(strip_tags($this->startDate));
        $this->endDate = htmlspecialchars(strip_tags($this->endDate));

        $stmt->bindParam(":titulo", $this->titulo);
        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":color",$this->color);
        $stmt->bindParam(":startDate",$this->startDate);
        $stmt->bindParam(":endDate",$this->endDate);

        if($stmt->execute()) {
            return true;
        }

        return false;
    }

    function update() {
        $query = "UPDATE " . $this->table_name 
        . " SET 
        titulo=:titulo,
        descripcion=:descripcion,
        fecha=:fecha 
        WHERE 
        id_actividad=:id_actividad";

        $stmt = $this->conn->prepare($query);

        $this->titulo=htmlspecialchars(strip_tags($this->titulo));
        $this->descripcion=htmlspecialchars(strip_tags($this->descripcion));
        $this->fecha=htmlspecialchars(strip_tags($this->fecha));
    
        $stmt->bindParam(":titulo", $this->titulo);
        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":fecha", $this->fecha);
        $stmt->bindParam(":id_actividad", $this->id_actividad);
    
        if($stmt->execute()){
            return true;
        }

        return false;
    }

    function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_actividad = ?";
        $stmt = $this->conn->prepare($query);
        $this->id_actividad=htmlspecialchars(strip_tags($this->id_actividad));
        $stmt->bindParam(1, $this->id_actividad);

        if($stmt->execute()){
            return true;
        }

        return false;
    }
}
?>