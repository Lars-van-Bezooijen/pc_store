<?php 
session_start();

if(isset($_SESSION['user_id']))
{
    header("location: $base_url/index.php");
}

$email = $_POST['email'];
$password = $_POST['password'];

require_once 'conn.php';
$query = "SELECT * FROM users WHERE email = :email";
$statement = $conn->prepare($query);
$statement->execute([":email" => $email]);
$user = $statement->fetch(PDO::FETCH_ASSOC);

if($statement->rowCount() < 1){
    $_SESSION['error_login'] = "Error: inputs do not match";
    header("location: ../login.php");
    return;
}

if(!password_verify($password, $user['password'])){
    $_SESSION['error_login'] = "Error: inputs do not match";
    header("location: ../login.php");
    return;
}

$_SESSION['user_id'] = $user['id'];
header("location: $base_url/index.php");
?>
