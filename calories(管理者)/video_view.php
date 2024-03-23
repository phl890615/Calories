<?php
session_start();
if ($_SESSION['Name']=='manager'){
	
}else{
	header("refresh:0;url=manager.php");
}
$time = date('His', (time() + 7 * 3600));
//error_reporting(0);
if (isset($_POST['search']) != '') {
	$search = $_POST['search'];
	$data = "SELECT * FROM video where video_title LIKE '%$search%' order by video_id desc";
} else {
	$data = "SELECT * FROM video order by video_id desc";
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
			<h2>影片總覽</h2>
		</div>
		<table class="table table-borderless" style="width: 700px; margin: 0 auto;">
			<tr>
				<td>
					<form method="post" style='width: 700px;'>
						<div class="input-group mb-3" style=''>
							<span class="input-group-text" style="border-color:#6DC757;border-width:3px;background-color:#6AAD58" id="basic-addon1">請輸入標題:</span>
							<input type="text"  style="border-color:#6DC757;border-width:3px;background-color:transparent;;" name="search" class="form-control" aria-label="Username" aria-describedby="basic-addon1" required>
							<button type="submit" style="border-color:#6DC757;border-width:3px" class="btn btn-outline-success">搜尋</button>
						</div>
					</form>
				</td>
			</tr>
		</table>
		<?php
		include("connect.php");
		$result = mysqli_query($link, $data);
		for ($i = 1; $i <= mysqli_num_rows($result); $i++) {
			$rs = mysqli_fetch_row($result);

			$sql = "SELECT * FROM diet_plan where diet_plan_id = $rs[2]";
			$res = mysqli_query($link, $sql);
			for ($X = 1; $X <= mysqli_num_rows($res); $X++) {
				$co = mysqli_fetch_row($res);

				$mem_name = "SELECT * FROM member where mem_phone = $rs[1]";
				$name = mysqli_query($link, $mem_name);
				for ($j = 1; $j <= mysqli_num_rows($name); $j++) {
					$na = mysqli_fetch_row($name);

					$vmsg = "SELECT * FROM video_msg where video_id = $rs[0]";
					$msg = mysqli_query($link, $vmsg);
					$num = mysqli_num_rows($msg);
		?>
					<table class="" style="width: 700px; margin: 0 auto;padding: 0px; font-family:Arial;">
						<tr>
							<td><?php echo "<video width='700' height='500'  controls><source src='../video/$rs[0].mp4?$time' type='video/mp4'></video>"; ?></td>
						</tr>
					</table>
					<table style="width: 700px; margin: 0 auto;padding: 0px;font-family:微軟正黑體;">
						<tr>
							<td style="width: 150px;">
								<p style="font-size: 20px;color:black;"><?php echo $rs[0] ?><?php echo $na[2] ?></p>
							</td>
							<td style="width: 348px;">
								<p style="font-size: 20px;color:black"><?php echo $co[1] ?></p>
							</td>
							<td>
								<p style="font-size: 20px;color:#5B5B5B"><?php echo $rs[15] ?></p>
							</td>
						</tr>
					</table>
					<table style="width: 700px; margin: 0 auto;padding: 0px">
						<tr>
							<td>
								<p style="font-size: 25px;font-weight:bold;color:black"><?php echo $rs[3] ?></p>
							</td>
						</tr>
					</table>
					<table style="width: 700px; margin: 0 auto;padding: 0px">
						<tr>
							<?php
							if ($rs[1] == '0900000000') {
								echo "<td style='width:100px'>
										<a href='video_revise.php?id=$rs[0]'><input type='button' class='btn btn-success' value='修改影片資料'/></a>
									  </td>";
							} else {
								echo "";
							}
							?>
							<td>
								<a href='video_delet.php?id= <?php echo $rs[0]; ?>' style='font-size: 18px; float: left;' class='btn btn-success' onclick="return confirm('確認刪除')">刪除影片</a>
							</td>
						</tr>
						<tr>
							<td>
								<div class="btn-group" role="group" aria-label="Basic example">
									<?php
										$like = "SELECT * FROM video_like where video_id = $rs[0] and mem_phone = '0900000000'";
										$v_like = mysqli_query($link, $like);
										$nums = mysqli_num_rows($v_like);
										$nlike = "SELECT * FROM video_like where video_id = $rs[0]";
										$num_like = mysqli_query($link, $nlike);
										$likenums = mysqli_num_rows($num_like);
									?>
  									<button type="button" class='btn btn-primary'onclick="location.href='<?php echo "video_onemsg.php?id=" . $rs[0] ?>'"><?php echo $num; ?><img src="../picture/message.png" width="30"></button>
								</div>
							</td>
						</tr>
					</table>
					<hr/>
		<?php
				}
			}
		}


		?>
		</form>
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