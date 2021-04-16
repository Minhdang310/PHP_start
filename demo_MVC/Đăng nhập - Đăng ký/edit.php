<!DOCTYPE html>
<html>
<head>
	<title></title>
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
		#user_edit form{
			width: 700px;
			margin: 40px;
		}
		#user_edit form input{
			padding: 5px 0;
		}
	</style>
</head>
<body>
	<?php
	include './connect_db.php';
	$error = false;
	if (isset($_GET['action']) && $_GET['action'] == 'edit') {
		if (isset($_POST['user_id']) && !empty(['user_id']) && isset($_POST['old_password']) && !empty(['old_password']) && isset($_POST['new_password']) && !empty(['new_password'])
		) {
		$userResult = mysqli_query($con,"SELECT * FROM `user` WHERE (`id` = ". $_POST['user_id'] ." AND `password` = '". MD5($_POST['old_password'])."')");
		if ($userResult-> num_rows >0){
				$result = mysqli_query($con, "UPDATE `user` SET `password` = MD5('". $_POST['new_password'] ."'), `last_updated` = ". time() ." WHERE (`id` = ". $_POST['user_id'] ." AND `password` = MD5('". $_POST['old_password'] ."') ); ");
				if(!$result){
				$error = "Không thể cập nhật tài khoản";
			}
		}else{
		$error = "Mật khẩu cũ không đúng";						
		}
		mysqli_close($con);
		if($error !== false){
		?>
			<div id="error-notify" class="box-content">
				<h1>Thông báo</h1>
				<h4><?= $error ?></h4>
				<a href="./edit.php">Đổi lại mật khẩu</a>
			</div>
		<?php } else { ?>
		<div id="success-notify" class="box-content">
			<h1><?= ($error !== false) ? $error : "Sửa tài khoản thành công" ?></h1>
			<a href="./login.php">Quay lại tài khoản</a>
		</div>
		<?php } ?>
		<?php } else { ?>
		<div  id="error-notify" class="box-content">
			<h1>Vui lòng nhập đủ thông tin để sửa tài khoản</h1>
			<a href="./login.php">Quay lại sửa tài khoản</a>
		</div>
		<?php }
	} else { 
		session_start();
		$user = $_SESSION['current_user'];
		if (!empty($user)) { ?>
			<div id="edit_user" class="box-content">
				<form action="./edit.php?action=edit" method="post" autocomplete="off">
					<h1>Xin Chào "<?= $user['fullname'] ?>"</h1>
					<input type="hidden" name="user_id" value="<?= $user['id'] ?>">
					<p>Password cũ</p>
					<input type="password" name="old_password" value=""></br>
					<p>Password mới</p>
					<input type="password" name="new_password" value=""></br><br>
					<input type="submit" name="Edit">
				</form>
			</div>
			<?php }
		}
		?>
</body>
</html>