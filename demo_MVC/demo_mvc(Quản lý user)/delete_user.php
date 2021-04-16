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
		#delete_user{
			width: 200px;
			margin: 40px;
		}
		#delete_user{
			padding: 5px 0;
		}
    </style>
</head>
<body>
    <?php
    $error = false;
    if(isset($_GET['id']) && !empty($_GET['id'])) {
        include './connect_db.php';
        //kết nối db, thực hiện câu lệnh delete
        $result = mysqli_query($con, "DELETE FROM `user` WHERE `id` = ".$_GET['id']);
        if(!$result) {
            $error = "Không thể xóa tài khoản";
        }
    
        mysqli_close($con);
        if($error !== false){
        ?>
	        <div id="error-notify" class="box-content">
		        <h1>Thông báo</h1>
                <h4><?= $error ?></h4>
                <a href="./index.php">Danh sách tài khoản</a>
	        </div>
        <?php } else { ?>
            <div id="success-notify" class="box-content">
                <h1>Xóa tài khoản thành công</h1>
                <a href="./index.php">Danh sách tài khoản</a>
            </div>
        <?php } ?>
    <?php } ?>
</body>
</html>
