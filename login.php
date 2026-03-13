<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        "status" => 0,
        "message" => "Method Not Allowed"
    ]);
    exit;
}

session_start();
header('Content-Type: application/json');
include "config.php";

$un=trim($_POST['email']??'');
$pw=trim($_POST['password']??'');

$return_array=array();

if(empty($un)|| empty($pw))
	{
		$return_array['status']=0;
		$return_array['message']="please provide email and password";
		echo json_encode($return_array);
		exit;
	}

$sql = "SELECT * FROM users WHERE email=?";
$stmt=$conn->prepare($sql);
$stmt->bind_param("s",$un);
$stmt->execute();
$result =$stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    if (password_verify($pw, ($row['password']))) {
		$_SESSION['user_id']=$row['id'];
        $return_array['status'] = 1;
        $return_array['message'] = "Username and password are correct";
    } else {
        $return_array['status'] = 0;
        $return_array['message'] = "Invalid Credentials";
    }
} else {
    $return_array['status'] = 0;
    $return_array['message'] = "Invalid Credentials";
}
 echo json_encode($return_array);
?>