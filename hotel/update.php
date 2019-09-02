<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
// include database and object files
include_once '../config/database.php';
include_once '../objects/hotel.php';
// get database connection
$database = new Database();
$db = $database->getConnection();
// prepare hotel object
$hotel = new Hotel($db);
// get id_hotel of hotel to be edited
$data = json_decode(file_get_contents("php://input"));
// set id_hotel property of hotel to be edited
$hotel->id_hotel = $data->id_hotel;
// set hotel property values
$hotel->hotel_name = $data->hotel_name;
$hotel->city = $data->city;
$hotel->address = $data->address;
$hotel->phone_number = $data->phone_number;
$hotel->mail = $data->mail;
$hotel->category = $data->category;
// update the hotel
if($hotel->update()){
    // set response code - 200 ok
    http_response_code(200);
    // tell the user
    echo json_encode(array("message" => "hotel was updated."));
}
// if unable to update the hotel, tell the user
else{
    // set response code - 503 service unavailable
    http_response_code(503);
    // tell the user
    echo json_encode(array("message" => "Unable to update hotel."));
}
?>