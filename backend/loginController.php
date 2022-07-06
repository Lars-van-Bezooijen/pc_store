<?php 
session_start();

$email = $_POST['email'];
$password = $_POST['password'];

require_once 'conn.php';
$query = "SELECT * FROM users WHERE email = :email";
$statement = $conn->prepare($query);
$statement->execute([":email" => $email]);
$user = $statement->fetch(PDO::FETCH_ASSOC);

if($statement->rowCount() < 1){
    $_SESSION['no_account'] = true;
    header("location: $base_url/login.php");
}

if(!password_verify($password, $user['password'])){
    $_SESSION['no_account'] = true;
    header("location: $base_url/login.php");
}

$_SESSION['user_id'] = $user['id'];
header("location: $base_url/index.php");
?>
