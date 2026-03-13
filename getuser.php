<?php
session_start();
header('Content-Type: application/json');
include "config.php";

$response = array();

if (!isset($_SESSION['user_id'])) {
    $response['status'] = 0;
    $response['message'] = "Not logged in";
    echo json_encode($response);
    exit;
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT name, weight, age, bmi FROM users WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $response['status'] = 1;
    $response['data'] = $row;
} else {
    $response['status'] = 0;
    $response['message'] = "User not found";
}

echo json_encode($response);
?>