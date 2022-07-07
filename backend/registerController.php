<?php 
session_start();

// User is logged in? Return
if(isset($_SESSION['user_id']))
{
    header("location: $base_url/index.php");
}

// Input checks
$email = $_POST['email'];
if(filter_var($email, FILTER_VALIDATE_EMAIL) === false)
{
    $_SESSION['error_register'] = "Error: unvalid email type";
    header("location: ../register.php");
    return;
}

$password = $_POST['password'];
if(strlen($password) < 7)
{
    $_SESSION['error_register'] = "Error: passwords must be atleast 6 characters long";
    header("location: ../register.php");
    return;
}
$password_confirm = $_POST['password_confirm'];
if($password != $password_confirm)
{
    $_SESSION['error_register'] = "Error: passwords do not match";
    header("location: ../register.php");
    return;
}

require_once 'conn.php';
$query = "SELECT * FROM users WHERE email = :email";
$statement = $conn->prepare($query);
$statement->execute([":email" => $email]);
if($statement->rowCount() > 0)
{
    $_SESSION['error_register'] = "Error: this email is already registered, try logging in";
    header("location: ../register.php");
    return;
}

// Get other inputs
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$zipcode = $_POST['zipcode'];
$house_number = $_POST['house_number'];
if(isset($_POST['house_addition']))
{
    $house_addition = $_POST['house_addition'];
}
$streetname = $_POST['streetname'];
$place = $_POST['place'];

// Hash password and insert into database
$hash = password_hash($password, PASSWORD_DEFAULT);

$query = "INSERT INTO users (email, password, first_name, last_name, zipcode, house_number, house_addition, streetname, place) VALUES (:email, :hash, :first_name, :last_name, :zipcode, :house_number, :house_addition, :streetname, :place)";
$statement = $conn->prepare($query);
$statement->execute([
    ":email" => $email,
    ":hash" => $hash,
    ":first_name" => $first_name,
    ":last_name" => $last_name,
    ":zipcode" => $zipcode,
    ":house_number" => $house_number,
    ":house_addition" => $house_addition,
    ":streetname" => $streetname,
    ":place" => $place
]);

$_SESSION['success'] = "Account has been successfully registered, you can login now";
header("location: ../login.php");
exit;
?>