<?php
session_start();
include "config.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.html");
    exit;
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT name, weight, bmi FROM users WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i",$user_id);
$stmt->execute();

$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body{
    background: linear-gradient(135deg,#667eea,#764ba2);
    min-height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
    font-family: Arial, sans-serif;
}

.dashboard-card{
    background: rgba(255,255,255,0.15);
    padding:40px;
    border-radius:20px;
    backdrop-filter: blur(12px);
    box-shadow:0 10px 30px rgba(0,0,0,0.2);
    color:white;
}

h1{
    color:white;
    font-weight:600;
    margin-bottom:30px;
}

.card{
    background: rgba(255,255,255,0.15);
    border:none;
    border-radius:20px;
    backdrop-filter: blur(12px);
    box-shadow:0 10px 30px rgba(0,0,0,0.2);
    color:white;
}

.card p{
    background: rgba(255,255,255,0.2);
    padding:12px;
    border-radius:10px;
    margin-bottom:10px;
}

.btn-success{
    border-radius:10px;
    font-weight:600;
}
</style>

</head>

<body class="bg">

<div class="container mt-5">

<h1 class="text-center">Welcome <?php echo $user['name']; ?> 👋</h1>

<div class="card mt-4 p-4">

<p><b>Name:</b> <?php echo $user['name']; ?></p>

<p><b>Weight:</b> <?php echo $user['weight'] ?? "Not Added Yet"; ?></p>

<p><b>BMI:</b> <?php echo $user['bmi'] ?? "Not Calculated Yet"; ?></p>

<a href="details.html" class="btn btn-warning mt-3">
Calculate Calories Burned
</a>

</div>

</div>

</body>
</html>