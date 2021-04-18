<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style type="text/css">
		.product-items{
			width: 400px;
			padding: 50px;
		}
	</style>
</head>
<body>
	<?php 
	include './connect_db.php';
	$item_per_page = !empty($_GET['per_page'])?$_GET['per_page']:2;//Số item trong 1 Trang
	$current_page = !empty($_GET['page'])?$_GET['page']:1;//Trang ta chuyển tới
	$offset = ($current_page - 1) * $item_per_page;
	$products = mysqli_query( $con, "SELECT * FROM `products` ORDER BY `id` ASC LIMIT ".$item_per_page." OFFSET ".$offset);
	$totalRecords = mysqli_query($con,"SELECT * FROM `products`");
	$totalRecords = $totalRecords->num_rows;
	$totalPages = ceil($totalRecords/$item_per_page);
	?>
	<div class="container">
		<table>
			<h1>Danh sách sản phẩm</h1>
			<tr>
				<?php while ($row = mysqli_fetch_array($products)) { 
				?> 
				<td>
				<div class="product-items">
					<div class="product-img">
						<img src="<?= $row['image'] ?>" style="width: 400px; height: 400px;" title="<?= $row['name'] ?>"/>
					</div>
					<p><?= number_format($row['price'],0,",",".") ?> Đ</p>
					<p><?= $row['name'] ?></p>
					<div class="buy-button">
						<a href="./cart.php">Mua</a>
					</div>		
				</div>
				</td>
				<?php } ?>
			<tr>
		</table>
		<?php include './pagination.php'; ?>
		<div class="clear-both"></div>
	</div>
</body>
</html>