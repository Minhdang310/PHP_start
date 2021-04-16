<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Đăng ký tài khoản</title>
	<style type="text/css">
		.box-content{
			margin: 0 auto;
			width: 800px;
			border: 1px solid black;
			text-align: center;
			padding: 20px;
		}
		#user_register form{
			width: 700px;
			margin: 40px;
		}
		#user_register form input{
			padding: 5px 0;
		}
	</style>
</head>
<body>
		<?php include './connect_db.php';
				include './function.php';
			$error= false;
			if (isset($_GET['action']) && $_GET['action'] == 'reg') {
				if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password'])){
					$fullname = $_POST['fullname'];
					$birthday = $_POST['birthday'];
					$check = validateDateTime($birthday);
					if ($check) {
						$birthday = strtotime($birthday);
						$result = mysqli_query($con, "INSERT INTO `user` (`id`,`fullname`,`birthday`,`username`, `password`,`status`,`created_time`,`last_updated`) VALUES (NULL,'" . $_POST['fullname'] ."', '". $_POST['birthday'] ." ','" . $_POST['username'] . "', MD5('" . $_POST['password'] ."'),1, ".time()." ,'".time()."');");
						if(!$result) {
						if(strpos(mysqli_error($con),"Duplycate Entry") !== FALSE) {
							$error = "Tài khoản đã tồn tại";
						}	
					}
					mysqli_close($con);
			} else {
				$error =" Ngày tháng đăng nhập chưa chính xác";
			}
			if ($error !== false) {
			?>
				<div id="error-notify" class="box-content">
				<h1>Thông báo</h1>
				<h4><?= $error ?></h4>
				<a href="./register.php">Quay lại</a>
				</div>
			<?php } else { ?>
				<div id="success-notify" class="box-content">
				<h1>Thông báo</h1>
				<h4><?= ($error!== false) ? $error : "Đăng ký thành công"?></h4>
				<a href="./login.php">Mời bạn đăng nhập</a>
				</div>
			<?php } ?>
			<?php } else { ?>
				<div id="error-notify" class="box-content">
				<h1>Vui lòng nhập đủ thông tin để đăng ký</h>
				<a href="./register.php">Quay lại đăng ký</a>
				</div>
			<?php
				}
			} else { 
				?>
				<div id="user_register" class="box-content">
				<h1>Đăng ký tài khoản khác</h1>
				<form action="./register.php?action=reg" method="post">
					<p>Username</p>
					<input type="text" name="username" value=""><br/>
					<p>Password</p>
					<input type="password" name="password" value=""></br>
					<p>Họ và tên</p>
					<input type="text" name="fullname" value=""><br/>
					<p>Ngày sinh</p>
					<input type="text" name="birthday" value=""></br>
					<br>
					<br>
					<input type="submit" value="Đăng ký">
				</form>
			</div>
	<?php } ?>
</body>
</html>