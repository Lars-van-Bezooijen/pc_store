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
			<!-- Filters form -->
			<form action="" method="GET">
				<!-- Category filter -->
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
				<!-- Price high-low filter -->
				<div class="filter-group">
					<label for="price_sort">Price</label>
					<select name="price_sort" id="price_sort">
						<option hidden disabled selected value> -- choose sort -- </option>
						<option value="0">No sorting</option>
						<option value="1">High to low</option>
						<option value="2">Low to high</option>
					</select>
				</div>
				<!-- <div class="filter-group">
					<label for="price_min">Min</label>
					<input type="number" name="price_min" id="price_min" min="0">
					<label for="price_max">Max</label>
					<input type="number" name="price_max" id="price_max" min="0">
				</div> -->
				<input type="submit" value="Verzend">
			</form>
		</div>	
		
		<!-- Product start -->
		<div class="grid">
			<?php

			$queryStart = "SELECT products.*, categories.type";
			$queryEnd =
				" FROM products 
				INNER JOIN categories ON products.category = categories.id";
				
			// Check category filter
			if(isset($_GET['category']))
			{
				$cat = $_GET['category'];
				if($_GET['category'] == 0)
				{
					$category = " WHERE categories.id = categories.id";
				}
				else
				{
					$category = " WHERE categories.id = $cat";
				}	
				$queryEnd .= "$category";
			}
			else
			{
				$category = "categories.id";
			}

			// Check price sorting (Must be last added to query of filters)
			if(isset($_GET['price_sort']))
			{
				if($_GET['price_sort'] == 1)
				{
					$price_sort = " ORDER BY price DESC";
				}
				else if($_GET['price_sort'] == 2)
				{
					$price_sort = " ORDER BY price ASC";
				}
				else
				{
					$price_sort = "";
				}
				$queryEnd .= "$price_sort";
			}
			
			// Prepare product query
			$statement = $conn->prepare($queryStart . $queryEnd);
			$statement->execute([]);
			$products = $statement->fetchAll(PDO::FETCH_ASSOC);

			// Start product loop
			foreach($products as $product)
			{
				$price_format = number_format($product['price'], 2, ',', '.');
				if($product['price_off'] != 0)
				{
					$price_before = $product['price'] + $product['price_off'];
					$price_off_format = number_format($price_before, 2, ',', '.');
					$sale = (($product['price'] - $price_before) / $price_before) * 100;
				}
				?>

				<div class="product">
					<div class="image">
						<a href="product.php?id=<?php echo $product['id']; ?>">
							<img src="img/products/<?php echo $product['image'];?>" alt="">
						</a>
						<?php
						if($product['stock'] > 1)
						{
							if($product['price_off'] != 0)
							{
								if($sale < -10)
								{
									?>
									<p class="sale">HIGH SALE</p>
									<?php
								}
							}
						}
						?> 
					</div>
					
					<div class="info">
						<div class="side">
							<a class="underline" href="product.php?id=<?php echo $product['id']; ?>">
								<p class="title"><?php echo $product['name']; ?></p>
							</a>
							<?php
							if($product['stock'] < 1)
							{
								?>
								<p class="sale stock"> OUT OF STOCK</p>
								<?php
							}
							?>
							
						</div>
						<div class="side">
							<a href="product.php?id=<?php echo $product['id']; ?>">
								<p class="price">&euro; <?php echo $price_format; ?></p>
							</a>
							<?php
							if($product['price_off'] != 0)
							{
								?>
								<p class="price_off">&euro; <?php echo ($price_off_format); ?></p>		
								<?php
								
							}
							?>
							
							<p>CART BTN</p>
							<!-- <i class="fa-solid fa-cart-shopping"></i> -->
						</div>
					</div>
				</div>
				<?php
			} // End of product loop
			?>
		</div> <!-- End of grid -->
	</div> <!-- End of container -->

	<?php require_once 'scripts.php';?>
</body>

</html>