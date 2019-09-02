<?php
class Service{
    // conexión y tabla
    private $conn;
    private $table_service_name="Services";
    //propiedades tabla
    public $id_service;
    public $service_name; 
    //constructor
    public function Service($db){
        $this->conn = $db;
    }
    function read(){
        //select all data
        $query = "SELECT * FROM ". $this->table_service_name;  
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt;
    }
}
?>