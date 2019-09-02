<?php
class Database{
    //Credenciales de conección
    private $host = "localhost";
    private $db_name = "hotel_database";
    private $username = "root";
    private $password = "";
    private $db_sharset= "utf8";

    public $conn;
    //conexión con la base de datos
    public function getConnection(){
        $this->conn;
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name. ';charset=' . $this->db_sharset, $this->username, $this->password);
            $this->conn->exec("set names utf8");
           
        }catch(PDOExecption $exeption){
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }

}

?>              