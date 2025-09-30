<?php

class database{
    public $conn;

    //database connection
    public function __construct(){
        $this->conn = new mysqli("localhost","root","","user",3307);
        if($this->conn->connect_error){
            echo "Connection failed";
        }

    }

    //read whole table
    public function read(){
        $stmt = $this->conn->prepare("select * from users");
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        return $data;
    }

    //get user by id
    public function getUserById($id){
        $stmt = $this->conn->prepare("select * from users where id = ?");
        $stmt->bind_param("i",$id);

        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        return $data;
    }

    //row count
    public function rowCount(){
        $stmt = $this->conn->prepare("select * from users");

        $stmt->execute();
        $result = $stmt->get_result();
        $numRow = $result->num_rows;
        return $numRow;
    }


    //insert user 
    public function insert($id,$uname,$uemail,$uage,$ugender){
        $stmt = $this->conn->prepare("INSERT INTO users(id,name,email,age,gender)
                                     VALUES ('$id','$uname','$uemail','$uage','$ugender')
                                     On duplicate key UPDATE name='$uname',email='$uemail',age='$uage', gender='$ugender'");

        $stmt->execute();
        return true;
    }

    //delete user 
    public function delete($id){
        $stmt = $this->conn->prepare("delete from users where id = ?");
        $stmt->bind_param("i",$id);

        $stmt->execute();
        return true;
    }

}


?>