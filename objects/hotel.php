<?php
class Hotel{
    // conexión y tabla
    private $conn;
    private $table_hotel_name="hotels";
    //propiedades tabla
    public $id_hotel;
    public $hotel_name;
    public $cty;
    public $address;
    public $phone_number;
    public $mail;
    public $category;
    //constructor
    public function Hotel($db){
        $this->conn = $db;
    }
    function read(){
        //select all data
        $query = "SELECT * FROM ". $this->table_hotel_name;  
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt;
    }
    function create(){
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_hotel_name . "
                SET
                    hotel_name=:hotel_name, city=:city, address=:address, phone_number=:phone_number, mail=:mail , category=:category";
        // prepare query
        $stmt = $this->conn->prepare($query);
        // sanitize
        $this->hotel_name=htmlspecialchars(strip_tags($this->hotel_name));
        $this->city=htmlspecialchars(strip_tags($this->city));
        $this->address=htmlspecialchars(strip_tags($this->address));
        $this->phone_number=htmlspecialchars(strip_tags($this->phone_number));
        $this->mail=htmlspecialchars(strip_tags($this->mail));
        $this->category=htmlspecialchars(strip_tags($this->category));
        // bind values
        $stmt->bindParam(":hotel_name", $this->hotel_name);
        $stmt->bindParam(":city", $this->city);
        $stmt->bindParam(":address", $this->address);
        $stmt->bindParam(":phone_number", $this->phone_number);
        $stmt->bindParam(":mail", $this->mail);
        $stmt->bindParam(":category", $this->category);
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    } 
    // used when filling up the update hotel form
function readOne(){
    // query to read single record
    $query = "SELECT
                *
            FROM
                " . $this->table_hotel_name . " WHERE id_hotel=".$this->id_hotel;
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
    // bind id_hotel of hotel to be updated
    $stmt->bindParam(1, $this->id_hotel);
    // execute query
    $stmt->execute();
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // set values to object properties
    $this->hotel_name = $row['hotel_name'];
    $this->city = $row['city'];
    $this->address = $row['address'];
    $this->phone_number = $row['phone_number'];
    $this->mail = $row['mail'];
    $this->category = $row['category'];
}
function update(){
 
    // update query
    $query = "UPDATE
                " . $this->table_hotel_name . "
            SET
                hotel_name = :hotel_name,
                city = :city,
                address = :address,
                phone_number = :phone_number,
                mail = :mail,
                category = :category
            WHERE
                id_hotel = :id_hotel";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->hotel_name=htmlspecialchars(strip_tags($this->hotel_name));
    $this->city=htmlspecialchars(strip_tags($this->city));
    $this->address=htmlspecialchars(strip_tags($this->address));
    $this->phone_number=htmlspecialchars(strip_tags($this->phone_number));
    $this->id_hotel=htmlspecialchars(strip_tags($this->id_hotel));
 
    // bind new values
    $stmt->bindParam(':hotel_name', $this->hotel_name);
    $stmt->bindParam(':city', $this->city);
    $stmt->bindParam(':address', $this->address);
    $stmt->bindParam(':phone_number', $this->phone_number);
    $stmt->bindParam(':mail', $this->mail);
    $stmt->bindParam(':category', $this->category);
    $stmt->bindParam(':id_hotel', $this->id_hotel);
 
    // execute the query
    if($stmt->execute()){
        return true;
    }

 
    return false;
}
// delete the HOTEL
function delete(){
    // delete query
    $query = "DELETE FROM " . $this->table_hotel_name . " WHERE id_hotel =".$this->id_hotel;
    // prepare query
    $stmt = $this->conn->prepare($query);
    // sanitize
    $this->id_hotel=htmlspecialchars(strip_tags($this->id_hotel));
    // bind id of record to delete
    $stmt->bindParam(1, $this->id_hotel);
    // execute query
    if($stmt->execute()){
        return true;
    }
    return false;
     
}
function search($keywords){
 
    // select all query
    $query = "SELECT
                *
            FROM
                " . $this->table_hotel_name . " 
                
            WHERE
                hotel_name LIKE ? OR city LIKE ? 
            ";
    // prepare query statement
    $stmt = $this->conn->prepare($query);
    // sanitize
    $keywords=htmlspecialchars(strip_tags($keywords));
    $keywords = "%{$keywords}%";
    // bind
    $stmt->bindParam(1, $keywords);
    $stmt->bindParam(2, $keywords);
    
 
    // execute query
    $stmt->execute();
 
    return $stmt;
}   
}
// update the hotel

?>