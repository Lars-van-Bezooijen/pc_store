<?php session_start(); ?>
<!doctype html>
<html class="no-js" lang="">

<head>
	<?php require_once 'head.php'; ?>
	<title>PC Today - Home</title>
</head>

<body>
	<?php 
	require_once 'backend/conn.php'; 
	require_once 'header.php';
	?>
	<div class="banner">
		<div class="container">
			<div class="width">
				<h1>WELCOME TO PC TODAY&trade;</h1>
				<p class="p-header">Order your PC components today at PC Today</p>
				<a href="<?php echo $base_url; ?>/shop.php">
				<p>Start Shopping</p>
				<i class="fa-solid fa-angle-right"></i>
				</a>
			</div>
		</div>
    </div>

















	<?php require_once 'scripts.php'; ?>
</body>

</html>
