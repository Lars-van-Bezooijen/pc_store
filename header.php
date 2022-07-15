<header>
	<div class="container">
		<div class="header-top">
			<div class="block flex-start">
				<a href="<?php echo $base_url; ?>/index.php">
					<h1>PC</h1>
					<img src="img/Logo.png" alt="pc today">
				</a>
			</div>
			<div class="block">
				<div class="info">
					<i class="fa-solid fa-clock"></i>
					<div class="info-text">
						<p>Monday - Friday</p>
						<p>8:00AM-8:00PM</p>
					</div>
				</div>
				<div class="info">
					<i class="fa-solid fa-phone"></i>
					<div class="info-text">
						<p>Call Us</p>
						<p>+2 947 93854 438</p>
					</div>
				</div>
				<div class="info social-media">
					<a href="https://facebook.com" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
					<a href="https://twitter.com" target="_blank"><i class="fa-brands fa-twitter"></i></a>
					<a href="https://instagram.com" target="_blank"><i class="fa-brands fa-instagram"></i></a>	
				</div>
				<div class="info">
					<?php
					if(isset($_SESSION['user_id']))
					{
						$query = "SELECT * FROM users WHERE id = :id";
						$statement = $conn->prepare($query);
						$statement->execute([":id" => $_SESSION['user_id']]);
						$user = $statement->fetch(PDO::FETCH_ASSOC);
						?>
						<p>Welcome, <?php echo $user['first_name']; ?></p>
						<p class="p-space">|</p>
						<a class="a-underline" href="<?php echo $base_url; ?>/logout.php">Logout</a>
						<?php
					}
					else
					{
						?>
						<a class="a-underline" href="<?php echo $base_url; ?>/login.php">Login</a>
						<p class="p-space">|</p>
						<a class="a-underline" href="<?php echo $base_url; ?>/register.php">Register</a>
						<?php
					}
					?>
					
				</div>
			</div>
		</div>
		<div class="nav-bar">
			<div class="nav-bar-list">
				<?php 
				if(basename($_SERVER['PHP_SELF']) == "index.php")
				{
					$index = true;
				}
				if(basename($_SERVER['PHP_SELF']) == "shop.php")
				{
					$shop = true;
				}
				if(basename($_SERVER['PHP_SELF']) == "about.php")
				{
					$about = true;
				}
				if(basename($_SERVER['PHP_SELF']) == "contact.php")
				{
					$contact = true;
				}
			
				?>
				<div class="nav-split">
					<a class="a-underline <?php if(isset($index)){echo "colored";}?>" href="<?php echo $base_url; ?>/index.php">Home</a>
					<a class="a-underline <?php if(isset($shop)){echo "colored";}?>" href="<?php echo $base_url; ?>/shop.php">Shop</a>
					<a class="a-underline <?php if(isset($about)){echo "colored";}?>" href="<?php echo $base_url; ?>/about.php">About</a>
					<a class="a-underline <?php if(isset($contact)){echo "colored";}?>" href="<?php echo $base_url; ?>/contact.php">Contact</a>
				</div>

				<div class="nav-split">
				<?php
				if(isset($_SESSION['user_id']))
				{
					$query = "SELECT * FROM users WHERE id = :id";
					$statement = $conn->prepare($query);
					$statement->execute([":id" => $_SESSION['user_id']]);
					$user = $statement->fetch(PDO::FETCH_ASSOC);
					if($user['user_level'] == 1)
					{
						if(basename($_SERVER['PHP_SELF']) == "create.php")
						{
							$create = true;
						}
						if(basename($_SERVER['PHP_SELF']) == "edit.php")
						{
							$edit = true;
						}
						if(basename($_SERVER['PHP_SELF']) == "orders.php")
						{
							$orders = true;
						}
						?>
						<a class="a-none" href="">Admin ></a>
						<a class="a-underline <?php if(isset($create)){echo "colored";}?>" href="<?php echo $base_url; ?>/create.php">Create</a>
						<a class="a-underline <?php if(isset($edit)){echo "colored";}?>" href="<?php echo $base_url; ?>/edit.php">Edit</a>
						<a class="a-underline <?php if(isset($orders)){echo "colored";}?>" href="<?php echo $base_url; ?>/orders.php">Orders</a>
						<?php
					}
				}
				?>
				</div>
			</div>
			<div class="fill"></div>
		</div>
	</div>
</header>