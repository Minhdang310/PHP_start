<!DOCTYPE html>
<html>
<head>
	<title>Bài 1</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style type="text/css">
		table, tr, td{
			border: 1px solid black;
		}
		#user-info{
			border: 1px solid #ccc;
			width: 700px;
			margin: 0 auto;
			padding: 25px;
		}
		#user-info table{
			margin: 10px auto 0 auto;
			text-align: center;
		}
		#user-info h1{
			text-align: center;
		}
	</style>
</head>
<body>
	<?php 
	include './connect_db.php';
	$result = mysqli_query($con, "SELECT * FROM user");
	mysqli_close($con);
	?>
	<div id="user-info">
		<h1>Danh sách người dùng</h1>
		<a href="./create_user.php">Tạo tài khoản</a>
		<table id="user-listing" style="width: 700px;">
			<tr>
			<td>UserName</td>
			<td>Fullname</td>
			<td>Trạng thái</td>
			<td>Lần cập nhật cuối</td>
			<td>Ngày lập</td>
			<td>Sửa</td>	
			<td>Xóa</td>
			</tr>
			<?php 
			while ($row = mysqli_fetch_array($result)){;
			?>
			<tr>
				<td><?= $row['username'] ?></td>
				<td><?= $row['fullname'] ?></td>
				<td><?= $row['status'] == 1?"Kích hoạt" : "Block" ?></td>
				<td><?= date('d/m/Y H:i',$row['last_updated']) ?></td>
				<td><?= date('d/m/Y H:i',$row['created_time']) ?></td>
				<td><a href="./edit_user.php?id=<?= $row['id'] ?>">Sửa</a></td>
				<td><a href="./delete_user.php?id=<?= $row['id'] ?>">Xóa</a></td>
			</tr>
			<?php } ?>
		</table>	
	</div>
</body>
</html>