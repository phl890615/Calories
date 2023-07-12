<?php
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
	<link rel="stylesheet" type="text/css" href="css/mobile.css">
	<script type='text/javascript' src='js/mobile.js'></script>
</head>

<body>
	<div id="header">
		<h1><a href="index.php">WELCOME<span>熱力適攝</span></a></h1>
		<ul id="navigation">
			<li class="current">
				<a href="index.php">首頁</a>
			</li>
			<li>
				<a href="user.php">會員管理</a>
			</li>
			<li>
				<a href="video_view.php">影片管理</a>
				<ul>
					<li>
						<a href="videotext_add.php">管理者新增影片</a>
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
	<div id="body">
		<div style="text-align: center">
			<h2>影片總覽</h2>
		</div>
		<table class="table table-borderless" style="width: 700px; margin: 0 auto;">
			<tr>
				<td>
					<form method="post">
						<div class="input-group mb-3">
							<span class="input-group-text" id="basic-addon1">請輸入標題:</span>
							<input type="text" name="search" class="form-control" aria-label="Username" aria-describedby="basic-addon1">
							<button type="submit" class="btn btn-outline-success">搜尋</button>
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



					if ($rs[7] == 0) $get_fav = "素食";
					if ($rs[7] == 1) $get_fav = "蛋奶素";
					if ($rs[7] == 2) $get_fav = "葷食";
					if ($rs[8] == 1) $get_glut = "麩質、";
					else $get_glut = "";
					if ($rs[9] == 1) $get_milk = "奶類、";
					else $get_milk = "";
					if ($rs[10] == 1) $get_crust = "甲殼類、";
					else $get_crust = "";
					if ($rs[11] == 1) $get_fish = "魚類、";
					else $get_fish = "";
					if ($rs[12] == 1) $get_nut = "堅果類、";
					else $get_nut = "";
					if ($rs[13] == 1) $get_bean = "豆類";
					else $get_bean = "";
					if ($rs[14] == 1) {
						$get_level = "毫無難度";
					} elseif ($rs[14] == 2) {
						$get_level = "新手";
					} elseif ($rs[14] == 3) {
						$get_level = "正常";
					} elseif ($rs[14] == 4) {
						$get_level = "稍難";
					} else {
						$get_level = "困難";
					}
		?>
					<table class="table table-striped" style="width: 700px; margin: 0 auto;padding: 0px;font-family:微軟正黑體;">
						<tr>
							<td style="width: 160px;">
								<p style="font-size: 20px;">影片ID:</p>
							</td>
							<td>
								<p style="font-size: 15px;"><?php echo $rs[0] ?></p>
							</td>
						</tr>
						<tr>
							<td>
								<p style="font-size: 20px;">發布者:</p>
							</td>
							<td>
								<p style="font-size: 15px;"><?php echo $na[2] ?>
							</td>
						</tr>
						<tr>
							<td>
								<p style="font-size: 20px;">影片標題:</p>
							</td>
							<td>
								<p style="font-size: 15px;"><?php echo $rs[3] ?>
							</td>
						</tr>
						<tr>
							<td>
								<p style="font-size: 20px;">飲食法:</p>
							</td>
							<td>
								<p style="font-size: 15px;"><?php echo $co[1] ?>
							</td>
						</tr>
						<tr>
							<td>
								<p style="font-size: 20px;">飲食偏好:</p>
							</td>
							<td>
								<p style="font-size: 15px;"><?php echo $get_fav ?>
							</td>
						</tr>
						<tr>
							<?php
							if ($rs[1] == '0900000000') {
								echo "<td><a href='video_revise.php?id=$rs[0]' >修改影片資料</a></td>";
							} else {
								echo "";
							}
							?>
							<td><a href="<?php echo "video_delet.php?id=" . $rs[0] ?> " onclick="return confirm('確認刪除')">刪除影片</a>
							</td>
						</tr>
						<tr>
							<?php
							$like = "SELECT * FROM video_like where video_id = $rs[0] and mem_phone = '0900000000'";
							$v_like = mysqli_query($link, $like);
							for ($k = 1; $k <= mysqli_num_rows($v_like); $k++) {
								$li = mysqli_fetch_row($v_like);
								$nums = mysqli_num_rows($v_like);
							?>
							<?php
							}
							?>
							<?php
							if ($li[3] == 1) {
								echo "<td><button type='button' class='btn btn-danger' id='btn_collect$k' value='$rs[0]'><img src='../picture/heart.png' width='30'></button></td>";
							} else {
								echo "<td><button type='button' class='btn btn-primary' id='btn_collect$k' value='$rs[0]'><img src='../picture/heart.png' width='30'></button></td>";
							}
							?>
							<td><button type="button" onclick="location.href='<?php echo "video_onemsg.php?id=" . $rs[0] ?>'"><?php echo $num; ?><img src="../picture/message.png" width="30"></button></td>
						</tr>
					</table>
					<br />
					<table class="table table-borderless" style="width: 500px;margin:0 auto">
						<tr>
							<td><?php echo "<video width='700'  controls><source src='../video/$rs[0].mp4' type='video/mp4'></video>"; ?></td>
						</tr>
					</table>
					<br />
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
	<script>
		$(document).ready(function() {
			$("button[id^='btn_collect']").click(function() {
				var id = '0900000000';
				var v_id = $(this).val();
				var classname = $(this).attr("class");
				$(this).removeClass("btn btn-primary btn btn-danger");
				if (classname == "btn btn-primary") {
					$(this).addClass("btn btn-danger");
					alert("收藏成功");
					$.ajax({
						url: 'video_like_insert.php',
						type: 'POST',
						data: 'id=' + id + '&v_id=' + v_id,
						success: function(result) {
							console.log(result);
						},
						error: function(xhr) {
							alert('Ajax request 發生錯誤');
						}
					});
				} else {
					$(this).addClass("btn btn-primary");
					alert("取消收藏");
					$.ajax({
						url: 'video_like_update.php',
						type: 'POST',
						data: 'id=' + id + '&v_id=' + v_id,
						success: function(result) {
							console.log(result);
						},
						error: function(xhr) {
							alert('Ajax request 發生錯誤');
						}
					});
				}
			});
		});
	</script>
</body>

</html>