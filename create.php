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
	<title>PC Today - Create</title>
</head>

<body>
    <?php  
    require_once 'backend/conn.php'; 
    require_once 'header.php'; 	
    ?>
    <div class="container">
        <div id="content" class="test">
            <p><?php echo rand(0,100); ?></p>
        </div>
        <div class="no">
            <button id="load_btn">Load me</button> 
        </div>
    </div>
    

    <?php require_once 'scripts.php';?>
    <script src="js/reload.js"></script>
</body>

</html>