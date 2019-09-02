<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
// include database and object files
include_once '../config/database.php';
include_once '../objects/hotel.php';
// get database connection
$database = new Database();
$db = $database->getConnection();
// prepare Hotel object
$hotel = new Hotel($db);
// set id_hotel property of record to read
$hotel->id_hotel = isset($_GET['id_hotel']) ? $_GET['id_hotel'] : die();
// read the details of Hotel to be edited

$hotel->readOne();
if($hotel->hotel_name!=null){
    // create array
    $hotel_arr = array(
        "id_hotel" =>  $hotel->id_hotel,
        "hotel_name" => $hotel->hotel_name,
        "city" => $hotel->city,
        "address" => $hotel->address,
        "phone_number" => $hotel->phone_number,
        "mail" => $hotel->mail,
        "category" => $hotel->category
    );
    // set response code - 200 OK
    http_response_code(200);
    // make it json format
    echo json_encode($hotel_arr);
}
else{
    // set response code - 404 Not found
    http_response_code(404);
    // tell the user Hotel does not exist
    echo json_encode(array("message" => "Hotel does not exist."));
}
?>