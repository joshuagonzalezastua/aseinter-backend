<?php
 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
 
include_once '../../db_conf/database.php'; 
include_once '../../entities/tiquete.php';

$database = new Database();
$db = $database->getConnection();
 
$tiquete = new tiquete($db);
 
$data = json_decode(file_get_contents("php://input"));
 
$tiquete->fecha = $data->fecha;
$tiquete->id_persona = $data->id_persona;
$tiquete->motivo = $data->motivo;

if($tiquete->create()) {

    $response = array(
        "id_persona" => $tiquete->id_persona,
        "fecha" => $tiquete->fecha,
        "motivo" => $tiquete->motivo
    );

    echo '"response":' . json_encode($response);
}
 
 
else {
    echo '"response": "-1"';
}
?>