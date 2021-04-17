<?php
//Hàm login sau khi mạng xã hội trả dữ liệu về
function loginFromSocialCallBack($socialUser){
	include './connect_db.php';
	$result = mysqli_query($con, "SELECT `id`,`fullname`,`username`,`email` FROM `user` WHERE `email`= '" .$socialUser['email']. "'");
	if ($result->num_rows == 0) {
		$result = mysqli_query($con, "INSERT INTO `user` (`fullname`,`email`,`status`,`created_time`,`last_updated`) VALUES ('".$socialUser['name']."','".$socialUser['email']."',1,'". time()."','". time()."');");
		if (!$result) {
			echo mysqli_error($con);
			exit;
		}
		$result = mysqli_query($con, "SELECT `id`,`username`,`fullname`,`email` FROM `user` WHERE `email`= '" .$socialUser['email']. "'");
	}
	if ($result->num_rows >0) {
		$user = mysqli_fetch_assoc($result);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		$_SESSION['current_user'] = $user;
		header('Location: ./login.php');
	}
}