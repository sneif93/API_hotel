<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
// database connection will be here
include_once '../config/database.php';
include_once '../objects/service.php';
//inicializar base de datos
$database = new Database();
$db = $database->getConnection();
// inicializar objeto
$service=new service($db);
$stmt=$service->read();
$num=$stmt->rowCount();
if($num>0){
    $services_arr=array();
    $services_arr["records"]=array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $service_item=array(
            "id_service" => $row["id_service"],
            "service_name" => $row["service_name"]
        );
        array_push($services_arr["records"],$service_item);
    }
    // set response code - 200 OK
    http_response_code(200);
 
    // show services data in json format
    echo json_encode($services_arr);   
}else{
 
    // set response code - 404 Not found
    http_response_code(404);
    
    // tell the user no services found
    echo json_encode(
        array("message" => "No services found.")
    );
}

?>