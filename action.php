<?php

require_once("db.php");
$db = new database();


//read
if(isset($_POST['action']) && $_POST['action'] == "view"){
    $output = "";
    $data = $db->read();
    foreach($data as $row){
        $output .= "<tr>
                      <td>".$row['name']."</td>
                      <td>".$row['email']."</td>
                      <td>".$row['age']."</td>
                      <td>".$row['gender']."</td>
                      <td><button class='edit' data-uid='".$row['id']."'>Edit</button>
                      <button class='delete' data-uid='".$row['id']."'>Delete</button></td>
                    </tr>";
    }
    echo $output;
}

//insert
if(isset($_POST['action']) && $_POST['action'] == "insert"){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    if(!empty($name) && !empty($email) && !empty($age) && !empty($gender) && $gender != "Select gender"){
         $db->insert($id,$name,$email,$age,$gender);
    echo "User data inserted successfully";
    }else{
        echo "Fill all fields";
    }
}

//deleted
if(isset($_POST['action']) && $_POST['action'] == "delete"){
   $id = $_POST['id'];
   if(!empty($id)){
    $db->delete($id);
    echo "User data deleted";
   }else{
    echo "User data not deleted";
   }
}


//edit
if(isset($_POST['action']) && $_POST['action'] == "edit"){
   $id = $_POST['id'];
   echo json_encode($db->getUserById($id));
}


?>