<?php
class Service_has_hotel{
    // conexión y tabla
    private $conn;
    private $table_service_has_hotel_name="services_has_hotels";
    //propiedades tabla
    public $services_id_services;
    public $hotels_id_hotel;
    public $state;
    public $qualification; 
    //constructor
    public function Service_has_hotel($db){
        $this->conn = $db;
    }
    function read(){
        //select all data
        $query = "SELECT * FROM ". $this->table_service_has_hotel_name;  
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt;
    }
}
?>