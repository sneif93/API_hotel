<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
// get database connection
include_once '../config/database.php';
// instantiate Hotel object
include_once '../objects/hotel.php';
$database = new Database();
$db = $database->getConnection();
$hotel = new Hotel($db);
// get posted data
$data = json_decode(file_get_contents("php://input"));
// make sure data is not empty
if(
    !empty($data->hotel_name) &&
    !empty($data->city) &&
    !empty($data->address) &&
    !empty($data->phone_number) &&
    !empty($data->mail) &&
    !empty($data->category)
){
    // set Hotel property values
    $hotel->hotel_name = $data->hotel_name;
    $hotel->city = $data->city;
    $hotel->address = $data->address;
    $hotel->phone_number = $data->phone_number;
    $hotel->mail = $data->mail;
    $hotel->category= $data->category;
    // create the Hotel
    if($hotel->create()){
        // set response code - 201 created
        http_response_code(201);
        // tell the user
        echo json_encode(array("message" => "Hotel was created."));
    }
    // if unable to create the Hotel, tell the user
    else{
        // set response code - 503 service unavailable
        http_response_code(503);
        // tell the user
        echo json_encode(array("message" => "Unable to create Hotel."));
    }
}
// tell the user data is incomplete
else{
    // set response code - 400 bad request
    http_response_code(400);
    // tell the user
    echo json_encode(array("message" => "Unable to create Hotel. Data is incomplete."));
}
?>