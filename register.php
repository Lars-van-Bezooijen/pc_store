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
	<title>PC Today - Register</title>
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
            <h2>User Registration</h2>
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
                        <div class="login-form">
                            <label for="password_confirm">Repeat Password</label>
                            <input type="password" id="password_confirm" name="password_confirm" required placeholder="repeat password">
                        </div>
                    </div>
                    <div class="split">
                        <div class="login-form">
                            <label for="first_name">First Name</label>
                            <input type="text" id="first_name" name="first_name" required placeholder="first name">
                        </div>
                        <div class="login-form">
                            <label for="last_name">Last Name</label>
                            <input type="text" id="last_name" name="last_name" required placeholder="last name">
                        </div>
                        <div class="login-form">
                            <label for="zipcode">Zipcode</label>
                            <input type="text" id="zipcode" name="zipcode" required placeholder="zipcode">
                        </div>
                        <div class="login-form">
                            <label for="house_number">House Number</label>
                            <input class="house-num" type="number" id="house_number" name="house_number" required placeholder="house number">
                            <input class="addition" type="text" id="house_addition" name="house_addition" placeholder="addition">
                        </div>
                        <div class="login-form">
                            <label for="streetname">Streetname</label>
                            <input type="text" id="streetname" name="streetname" required placeholder="streetname">
                        </div>
                        <div class="login-form">
                            <label for="place">Place</label>
                            <input type="text" id="place" name="zipplacecode" required placeholder="place">
                        </div>
                    </div>
               </div>         
                <div class="login-form">
                    <input type="submit" value="Register">
                    <p class="a-ref">Already have an account? Click <a href="<?php echo $base_url; ?>/register.php">here</a> to login</p>
                </div>
            </form>
        </div>
    </div>





    <?php require_once 'scripts.php'; ?>
</body>

</html>