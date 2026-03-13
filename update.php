<?php

session_start();
header("Content-Type: application/json");
include "config.php";

$response = array();

if(!isset($_SESSION['user_id'])){
    $response['status'] = 0;
    $response['message'] = "User not logged in";
    echo json_encode($response);
    exit;
}

$user_id = $_SESSION['user_id'];
$calories = $_POST['calories'] ?? '';

if(empty($calories)){
    $response['status'] = 0;
    $response['message'] = "Calories not provided";
    echo json_encode($response);
    exit;
}


$sql = "SELECT weight FROM users WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i",$user_id);
$stmt->execute();

$result = $stmt->get_result();
$user = $result->fetch_assoc();

$old_weight = $user['weight'];


$weight_loss = $calories / 7700;

$new_weight = $old_weight - $weight_loss;

$new_weight = round($new_weight,2);


$update = "UPDATE users SET weight=? WHERE id=?";
$stmt2 = $conn->prepare($update);
$stmt2->bind_param("di",$new_weight,$user_id);
$stmt2->execute();


$response['status'] = 1;
$response['message'] = "Weight Updated";
$response['new_weight'] = $new_weight;

echo json_encode($response);

?>