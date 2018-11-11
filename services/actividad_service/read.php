<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 

include_once '../../db_conf/database.php';
include_once '../../entities/actividad.php';
 
$database = new Database();
$db = $database->getConnection();
 
$actividad = new Actividad($db);
 
$stmt = $actividad->read();
$num = $stmt->rowCount();
 
if($num>0) {

   $actividad_arr=array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        	extract($row);
			$actividad_item=array(
            "id_actividad" => $id_actividad,
            "titulo" => $titulo,
            "descripcion" => $descripcion,
            "fecha" => $fecha
        );
        array_push($actividad_arr, $actividad_item);
    }
	echo json_encode($actividad_arr);
    
 }
 
else{
    echo json_encode(
        array("message" => "No se encontraron actividades")
    );
}
?>