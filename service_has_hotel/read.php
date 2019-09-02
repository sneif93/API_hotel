<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
// database connection will be here
include_once '../config/database.php';
include_once '../objects/service_has_hotel.php';
//inicializar base de datos
$database = new Database();
$db = $database->getConnection();

// inicializar objeto
$service_has_hotel=new Service_has_hotel($db);
$stmt=$service_has_hotel->read();
$num=$stmt->rowCount();

if($num>0){
    $service_has_hotels_arr=array();
    $service_has_hotels_arr["records"]=array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $service_has_hotel_item=array(
            "services_id_service" => $row["services_id_service"],
            "hotels_id_hotel" => $row["hotels_id_hotel"],
            "state"=>$row["state"],
            "qualification"=>$row["qualification"],
            
        );
        array_push($service_has_hotels_arr["records"],$service_has_hotel_item);

    }
    // set response code - 200 OK
    http_response_code(200);
 
    // show service_has_hotel data in json format
    echo json_encode($service_has_hotels_arr);   
}else{
 
    // set response code - 404 Not found
    http_response_code(404);
    
    // tell the user no service_has_hotel found
    echo json_encode(
        array("message" => "No service_has_hotel found.")
    );
}

?>