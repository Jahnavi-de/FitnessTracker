<?php
$servername = "sql100.infinityfree.com";
$username   = "if0_41380838";
$password   = "AV3Wnkl97y9";
$dbname     = "if0_41380838_fitness_app";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    header('Content-Type: application/json');
    http_response_code(500);
    echo json_encode([
        "status" => 0,
        "message" => "Database connection failed: " . mysqli_connect_error()
    ]);
    exit;
}
?>
