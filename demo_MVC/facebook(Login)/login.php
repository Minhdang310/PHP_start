<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Đăng nhập</title>
	<style type="text/css">
		.box-content{
			margin: 0 auto;
			width: 800px;
			border: 1px solid black;
			text-align: center;
			padding: 20px;
		}
		#user_login form{
			width: 700px;
			margin: 40px;
		}
		#user_login form input{
			padding: 5px 0;
		}
        img{
            width: 300px;
        }
	</style>
</head>
<body>  
<?php
        session_start();
        include './connect_db.php';
        $error = false;
        if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password'])) {
            $result = mysqli_query($con,"SELECT `id`,`username`,`fullname`,`birthday` FROM `user` WHERE (`username` = '".$_POST['username']."' AND `password` = MD5('" . $_POST['password']."'))");
            if(!$result) {
                $error = mysqli_error($con);
            } else {
                $user = mysqli_fetch_assoc($result);
                $_SESSION['current_user'] = $user;
            }
        mysqli_close($con);
        if ($error !== false || $result->num_rows == 0){
        ?>
        <div id="login-notify" class="box-content">
        <h1>Thông báo</h1>
        <h4><?= !empty($error)?$error: "Thông tin đăng nhập không chính xác"?></h4>
        <a href="./login.php">Quay lại </a>
        </div>
        <?php exit ;
        } ?>
        <?php } ?>
    <?php
    if (!empty($_SESSION['current_user'])) {
    	$currentUser = $_SESSION['current_user'];
    	?>
    	<div id="login-notify" class="box-content">
		<h1>Xin chào <?= $currentUser['fullname'] ?></h1>
        <a href="./edit.php">Vui lòng đổi mật khẩu ngay tại đây</a><br/><br/>
        <a href="./logout.php">Đăng xuất</a><br/>
	</div>
    <?php 
	 } else {
    include './facebook_source.php';
    ?>
        <div id="user_login" class="box-content">
            <h1>Đăng nhập tài khoản</h1>
            <form action="./login.php" method="post" autocomplete="off">
                <p>Username</p>
                <input type="text" name="username" value=""><br>
                <p>Password</p>
                <input type="password" name="password" value=""><br><br>
                <input type="submit" value="Đăng nhập">
            </form>
            <h2>Hoặc đăng nhập với mạng xã hội</h2>
            <div id="login-with-social">
                <a href="<?= $loginUrl ?>"><img src="images/facebook.png" alt="facebook login" title="Facebook Login"></a>
            </div>
        </div>
    <?php } ?>
</body>
</html>