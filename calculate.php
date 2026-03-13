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

$weight = $_POST['weight'] ?? '';
$height = $_POST['height'] ?? '';
$exercises = $_POST['exercises'] ?? '';

if(empty($weight) || empty($height) || empty($exercises)){
    $response['status'] = 0;
    $response['message'] = "Missing fields";
    echo json_encode($response);
    exit;
}

$exercise_array = json_decode($exercises, true);
if(!$exercise_array){
    $response['status'] = 0;
    $response['message'] = "Invalid exercise data";
    echo json_encode($response);
    exit;
}

$activity_MET = [
    'running' => 9,
    'walking' => 3.5,
    'cycling' => 6,
    'skipping' => 8,
    'swimming' => 7,
    'push-ups' => 4,
    'pull-ups' => 4,
    'squats' => 3.5,
    'lunges' => 3.5,
    'plank' => 3,
    'glute-bridge' => 3,
    'surya namaskar' => 3,
    'jumping jacks' => 8,
    'high knees' => 8,
    'leg raises' => 3.5,
    'sit-up' => 4,
    'mountain climbers' => 8,
    'stair climbing' => 6,
    'butterfly' => 5
];

$total_calories = 0;

foreach($exercise_array as $ex){
    $name = strtolower($ex['name']);
    $duration = floatval($ex['duration']);  
    $MET = $activity_MET[$name] ?? 3;      

    $calories = $MET * floatval($weight) * ($duration / 60);
    $total_calories += $calories;
}

$height_m = floatval($height) / 100;
$bmi = floatval($weight) / ($height_m * $height_m);

$total_calories = round($total_calories, 2);
$bmi = round($bmi, 2);

$update = "UPDATE users SET weight=?, height=?, bmi=? WHERE id=?";
$stmt3 = $conn->prepare($update);
$stmt3->bind_param("dddi",$weight,$height,$bmi,$user_id);
$stmt3->execute();

$sql = "INSERT INTO workout_data(user_id,weight,height,calories,bmi)
        VALUES(?,?,?,?,?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("idddd",$user_id,$weight,$height,$total_calories,$bmi);
$stmt->execute();
$workout_id = $conn->insert_id;

$sql2 = "INSERT INTO exercise_details(workout_id,exercise_name,reps,duration)
         VALUES(?,?,?,?)";
$stmt2 = $conn->prepare($sql2);
foreach($exercise_array as $ex){
    $name = $ex['name'];
    $reps = (int)$ex['reps'];
    $duration = floatval($ex['duration']);

    $stmt2->bind_param("isid",$workout_id,$name,$reps,$duration);
    $stmt2->execute();
}

$response['status'] = 1;
$response['calories'] = $total_calories;
$response['bmi'] = $bmi;

echo json_encode($response);
?>