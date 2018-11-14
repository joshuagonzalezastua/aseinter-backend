<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 

include_once '../../db_conf/database.php';
include_once '../../entities/tiquete.php';
 
$database = new Database();
$db = $database->getConnection();
 
$tiquete = new Tiquete($db);
 
$stmt = $tiquete->read();
$num = $stmt->rowCount();
 
if($num>0) {

   $tiquete_arr=array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        	extract($row);
			$tiquete_item=array(
            "id_tiquete" => $id_tiquete,
            "id_persona" => $id_persona,
            "fecha" => $fecha,
            "motivo" => $motivo
        );
        array_push($tiquete_arr, $tiquete_item);
    }
	echo json_encode($tiquete_arr);
    
 }
 
else{
    echo json_encode(
        array("message" => "No se encontraron tiquetes")
    );
}
?>