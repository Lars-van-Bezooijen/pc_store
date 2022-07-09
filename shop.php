<?php session_start(); ?>
<!doctype html>
<html class="no-js" lang="">

<head>
	<?php require_once 'head.php'; ?>
	<title>PC Today - Shop</title>
</head>

<body>
	<?php 
	require_once 'backend/conn.php'; 
	require_once 'header.php'; 	
	?>

	<div class="container flex">	
		<div class="filter">
			<form action="" method="GET">
				<div class="filter-group">
					<label for="category">Category</label>
					<select name="category" id="category" value="">
						<option hidden disabled selected value> -- choose category -- </option>
						<option value="0">All</option>
						<?php
						$query = "SELECT * FROM categories";
						$statement = $conn->prepare($query);
						$statement->execute([]);
						$categories = $statement->fetchAll(PDO::FETCH_ASSOC);
						foreach($categories as $category)
						{
							?>
							<option value="<?php echo $category['id']; ?>"><?php echo $category['type']; ?></option>
							<?php
						}
						?>
					</select>
				</div>
				<input type="submit" value="Verzend">
			</form>
		</div>	
		
		<div class="grid">
			<?php	
			if(isset($_GET['category']))
			{
				if($_GET['category'] == 0)
				{
					$category = "categories.id";
				}
				else
				{
					$category = $_GET['category'];
				}
				
			}
			else
			{
				$category = "categories.id";
			}
			
			$query = "SELECT products.*, categories.type
			FROM products INNER JOIN categories ON products.category = categories.id WHERE categories.id = $category";
			$statement = $conn->prepare($query);
			$statement->execute([]);
			$products = $statement->fetchAll(PDO::FETCH_ASSOC);
			foreach($products as $product)
			{
				$price_format = number_format($product['price'], 2, ',', '.');
				?>
				<div class="product">
					<a href="product.php?id=<?php echo $product['id']; ?>">
						<img src="img/products/<?php echo $product['image'];?>" alt="">
					</a>
					<div class="info">
						<div class="side">
							<a class="underline" href="product.php?id=<?php echo $product['id']; ?>">
								<p class="title"><?php echo $product['name']; ?></p>
							</a>
						</div>
						<div class="side">
							<a href="product.php?id=<?php echo $product['id']; ?>">
								<p class="price"><?php echo $price_format; ?></p>
							</a>
							<p>CART BTN</p>
							<!-- <i class="fa-solid fa-cart-shopping"></i> -->
						</div>
					</div>
				</div>
				<?php
			}
			?>
		</div>
	</div>
	<?php require_once 'scripts.php'; ?>
</body>

</html>
