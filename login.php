<?php
session_start();
if(isset($_SESSION['user_id']))
{
    header("location: index.php");
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

    if(isset($_SESSION['no_account']) || isset($_SESSION['wrong_pass']))
    {
        $_SESSION['no_account'] = null;
        $_SESSION['wrong_pass'] = null;
        ?>
        <div class="error">
            <p>Error: inputs do not match</p>
        </div>
        <?php
    }
    ?>
    
    <div class="login-body">
        <div class="login">
            <h2>User Login</h2>
            <p>Welcome</p>
            <form action="backend/loginController.php" method="POST">
                <div class="form-flex">
                    <div class="split">
                        <div class="login-form">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" required placeholder="yourmail@mail.com">
                        </div>
                        <div class="login-form">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" required placeholder="password">
                        </div>
                    </div>
                </div>         
                <div class="login-form">
                    <input type="submit" value="Login">
                    <p class="a-ref">Create account? Click <a href="<?php echo $base_url; ?>/register.php">here</a></p>
                </div>
            </form>
        </div>
    </div>

    <?php require_once 'scripts.php'; ?>
</body>

</html>