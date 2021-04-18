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
		if (isset($_POST['user_id']) && !empty(['user_id']) && isset($_POST['new_password']) && !empty(['new_password'])
		) {
		$userResult = mysqli_query($con,"SELECT * FROM `user` WHERE (`id` = ". $_POST['user_id'] .")");
		if ($userResult-> num_rows >0){
				$result = mysqli_query($con, "UPDATE `user` SET `password` = MD5('". $_POST['new_password'] ."'), `last_updated` = ". time() ." WHERE (`id` = ". $_POST['user_id'] ." ); ");
			?>
			<div id="success-notify" class="box-content">
			<h1><?= ($error !== false) ? $error : "Sửa tài khoản thành công" ?></h1>
			<a href="./login.php">Quay lại tài khoản</a>
			</div>
			<?php } 		
		 } 
	} else { 
		session_start();
		$user = $_SESSION['current_user'];
		if (!empty($user)) { ?>
			<div id="edit_user" class="box-content">
				<form action="./edit.php?action=edit" method="post" autocomplete="off">
					<h1>Xin Chào "<?= $user['fullname'] ?>"</h1>
					<input type="hidden" name="user_id" value="<?= $user['id'] ?>">
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