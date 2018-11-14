<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 

include_once '../../db_conf/database.php';
include_once '../../entities/usuario.php';
 
$database = new Database();
$db = $database->getConnection();
 
$usuario = new Usuario($db);
 
$stmt = $usuario->read();
$num = $stmt->rowCount();
 
if($num>0) {

   $usuario_arr=array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        	extract($row);
			$usuario_item=array(
            "nombre_usuario" => $nombre_usuario,
            "contrasena" => $contrasena
        );
        array_push($usuario_arr, $usuario_item);
    }
	echo json_encode($usuario_arr);
    
 }
 
else{
    echo json_encode(
        array("message" => "No se encontraron usuarios")
    );
}
?>