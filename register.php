<?php
header('Content-Type: application/json');
include "config.php";
if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])){
$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

if(empty($name) || empty($email) || empty($_POST['password']))
    {
        echo json_encode(["message"=>"All fields required"]);
        exit;
    }

$stmt=$conn->prepare("INSERT INTO users (name,email,password) VALUES (?,?,?)");
$stmt->bind_param("sss",$name,$email,$password);

if($stmt->execute()){
    echo json_encode(["message"=>"Registration Successful"]);
}

else
    {
        echo json_encode(["message"=>"Registration Failed"]);

    }
}
else
    {
        echo json_encode(["message"=>"No data received"]);
    }
    
?>