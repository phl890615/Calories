<?php
session_start();
if ($_SESSION['Name']=='manager'){
	
}else{
	header("refresh:0;url=manager.php");
}
if (isset($_POST['search']) != '') {
	$search = $_POST['search'];
	$data = "select * from member where mem_phone LIKE '%" . $search . "%'";
} else {
	$data = "select * from member";
}
?>
<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<html>

<head>
	
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">

	<meta charset="UTF-8">
	<meta name="viewport" content="user-scalable=0, width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<title>熱力適攝</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type='text/javascript' src='js/mobile.js'></script>
</head>

<body>
	<div id="header">
		<h1><a href="index.php">WELCOME<span>熱力適攝</span></a></h1>
		<ul id="navigation" style='line-height: 3;width: 1000px;font-size: 20px;'>
			<li class="current;">
				<a href="index.php">首頁</a>
			</li>
			<li>
				<a href="user.php">會員管理</a>
			</li>
			<li>
				<a href="video_view.php">影片管理</a>
				<ul>
					<li>
						<a href="videotext_add.php" style='font-size:19px;'>管理者新增影片</a>
					</li>
				</ul>
			</li>
			<li>
				<a href="diet_plan.php">飲食法管理</a>
			</li>
			<li>
				<a href="video_msg.php">留言管理</a>
			</li>
			<li>
				<a href="logout.php">登出</a>
			</li>
		</ul>
	</div>
	<div id="body" style='background:linear-gradient(#9CD98C, #457349); '>
		<div style="text-align: center">
			<h2>會員總覽</h2>
		</div>
		<form method="post">
			<div class="input-group mb-3">
				<span class="input-group-text"  style="border-color:#6DC757;border-width:3px;background-color:#6AAD58" id="basic-addon1">請輸入電話:</span>
				<input type="text" style="border-color:#6DC757;border-width:3px;background-color:transparent;" name="search" class="form-control" aria-label="Username" aria-describedby="basic-addon1" required>
				<button type="submit" style="border-color:#6DC757;border-width:3px" class="btn btn-outline-success">搜尋</button>
			</div>
		</form>
		<p></p>
		<table class="table table-striped ;table table-hover ;" align="center" width="600" style='background-color:white;'>
			<tr>
				<td>
					<h3>
						<p class="font-1">編號</p>
					</h3>
				</td>
				<td>
					<h3>
						<p class="font-1">暱稱</p>
					</h3>
				</td>
				<td>
					<h3>
						<p class="font-1">電子信箱</p>
					</h3>
				</td>
				<td>
					<h3>
						<p class="font-1">會員電話</p>
					</h3>
				</td>
				<td>
					<h3>
						<p class="font-1">狀態</p>
					</h3>
				</td>
				<td>
					<h3>
						<p class="font-1">檢視</p>
					</h3>
				</td>
				<?php
				include("connect.php");
				$rs = mysqli_query($link, $data);
				for ($i = 1; $i <= mysqli_num_rows($rs); $i++) {
					$co = mysqli_fetch_row($rs);
					if($co[5]=='0900000000'){
						continue;
					}
					$get_co;
					if ($co[9] == 0) $get_co = '正常';
					else $get_co = '封鎖';

				?>
			<tr>
				<td>
					<h4><?php echo $i-1 ?></h4>
				</td>
				<td>
					<h4><?php echo $co[2] ?><h4>
				</td>
				<td>
					<h4><?php echo $co[6] ?></h4>
				</td>
				<td>
					<h4><?php echo $co[5] ?></h4>
				</td>
				<td>
					<h4><?php echo $get_co ?></h4>
				</td>
				<td>
					<h4><?php echo "<a href='userselect.php?phone=$co[5]'>檢視</a>";
						}
							?></h4>
				</td>
			</tr>

		</table>
	</div>
	<div id="footer">
		<div>
			<span>110年專題組</span>
		</div>
	</div>
	<!-- Optional JavaScript; choose one of the two! -->

	<!-- Option 1: Bootstrap Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>

	<!-- Option 2: Separate Popper and Bootstrap JS -->
	<!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous"></script>
    -->
</body>

</html>