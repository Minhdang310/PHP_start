<!DOCTYPE html>
<html>
<head>
	<title>Create User</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style type="text/css">
		.box-content{
			margin: 0 auto;
			width: 800px;
			border: 1px solid black;
			text-align: center;
			padding: 20px;
		}
		#creare_user form{
			width: 200px;
			margin: 40px;
		}
		#create_user form input{
			padding: 5px 0;
		}
	</style>
</head>
<body>
	<?php
	$error = false;
	if (isset($_GET['action']) && $_GET['action'] == 'create'){
		if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password'])){
			include './connect_db.php';
			//Thêm bản ghi vào cơ sở dữ liệu
			$result = mysqli_query($con, "INSERT INTO `user` (`id`,`username`, `password`,`status`,`created_time`,`last_updated`) VALUES (NULL, '" . $_POST['username'] . "', MD5('" . $_POST['password'] ."'),1, ".time()." ,'".time()."');");
			if(!$result) {
				if(strpos(mysqli_error($con),"Duplycate Entry") !== FALSE) {
					$error = "Tài khoản đã tồn tại";
				}	
			}
		mysqli_close($con);
		if ( $error !== false) {
			 ?>
		<div id="error-notify" class="box-content">
			<h1>Thông báo</h1>
			<h4><?= $error ?></h4>
			<a href="./creare_user.php">Tạo tài khoản khác</a>
		</div>
		<?php } else { ?>
	<div id="success-notify" class="box-content">
		<h1>Chúc mừng</h1>
		<h4>Bạn đã tạo tài khoản thành công <?= $_POST['username'] ?></h4>
		<a href="./index.php">Danh sách tài khoản</a>
	</div>
			<?php } ?>
		<?php } ?>
	<?php } else { ?>
	<div id="create_user" class="box-content">
		<h1>Tạo tài khoản</h1>
		<form action="./create_user.php?action=create" method="post" autocomplete="off">
			<p>Username</p>
			<input type="text" name="username" value="">
			<p>Password</p>
			<input type="Password" name="password" value="">
			<br><br>
			<input type="submit" value="create">
		</form>
	</div>
	<?php } ?>
</body>
</html>