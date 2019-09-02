<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
// database connection will be here
include_once '../config/database.php';
include_once '../objects/hotel.php';
//inicializar base de datos
$database = new Database();
$db = $database->getConnection();

// inicializar objeto
$hotel=new Hotel($db);
$stmt=$hotel->read();
$num=$stmt->rowCount();

if($num>0){
    $hotels_arr=array();
    $hotels_arr["records"]=array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $hotel_item=array(
            "id_hotel" => $row["id_hotel"],
            "hotel_name" => $row["hotel_name"],
            "city"=>$row["city"],
            "address"=>$row["address"],
            "phone_number"=>$row["phone_number"],
            "mail"=>$row["mail"],
            "category"=>$row["category"]
        );
        array_push($hotels_arr["records"],$hotel_item);

    }
    // set response code - 200 OK
    http_response_code(200);
 
    // show hotel data in json format
    echo json_encode($hotels_arr);   
}else{
 
    // set response code - 404 Not found
    http_response_code(404);
    
    // tell the user no hotel found
    echo json_encode(
        array("message" => "No hotel found.")
    );
}

?>