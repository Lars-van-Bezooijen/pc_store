<?php
session_start();
if(isset($_SESSION['user_id']))
{
    require_once 'backend/conn.php';
    $query = "SELECT * FROM users WHERE id = :id";
    $statement = $conn->prepare($query);
    $statement->execute([":id" => $_SESSION['user_id']]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    if($user['user_level'] != 1)
    {
        header("location: index.php");
    }
    
}
?>
<!doctype html>
<html class="no-js" lang="">

<head>
	<?php require_once 'head.php'; ?>
	<title>PC Today - Login</title>
</head>

<body>
    <?php  
    require_once 'backend/conn.php'; 
    require_once 'header.php'; 	
    ?>
    

    <?php require_once 'scripts.php'; ?>
</body>

</html>