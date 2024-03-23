
<?php
$time = date('His', (time() + 7 * 3600));
include("controller.php");
include_once("connection.php");
error_reporting(0);
$mem_phone = $_SESSION['mem_phone'];
$sql = "SELECT * FROM member WHERE mem_phone ='$mem_phone'";
if (isset($_POST['search']) != '') {
	$search = $_POST['search'];
	$data = "SELECT * FROM video_like where video_title LIKE '%$search%' and mem_phone = '$mem_phone' order by video_id desc";
} else {
	$data = "SELECT * FROM video_like where mem_phone = '$mem_phone' order by video_id desc";
}

//$sql = "SELECT * FROM member WHERE mem_phone ='$mem_phone'";

?>

<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<meta charset="UTF-8">
	<title>熱力適攝</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
</head>

<body>
	<div id="page">
		<div id="header">
		<a href="index.php" id="logo"><img src="images/logo3.png" alt="Logo"></a>
		<ul>
				<li>
					<a href="index.php">首頁</a>
				</li>
				<li>
					<a href="membercentre.php">會員中心</a>
					<ul>
						<li>
							<a href="userprofile.php">會員資料</a>
						</li>
						<li>
							<a href="tdee.php">每日消耗熱量(TDEE)</a>
						</li>
						<li>
							<a href="changepassword.php">修改密碼</a>
						</li>
						<li>
							<a href="contactus.php">聯絡我們</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="weightrecord.php">體重紀錄</a>
				</li>
				<li>
					<a href="video_view.php">影片分享</a>
					<ul>
						<li>
							<a href="videotext_add.php">發佈影片</a>
						</li>
						<li>
							<a href="video_my.php">我的影片</a>
						</li>
						<li>
							<a href="video_like.php">我的最愛</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="diet-plan2.php">飲食計畫</a>
				</li>
				<li>
					<a href="logout.php">登出</a>
				</li>
			</ul>
		</div>
		<div id="body">
        
        <div align="center">
       <hr>
            <h1>我的最愛</h1>
       <hr>
		
		
		<table class="table table-borderless" style="width: 700px; margin: 0 auto;">
			<tr>
				<td>
					<form method="post" style='width: 700px;'>
						<div class="input-group mb-3">
							<span style='font-size: 20px;' class="input-group-text" id="basic-addon1">請輸入標題:</span>
							<input style='font-size: 20px;' type="text" name="search" class="form-control" aria-label="Username" aria-describedby="basic-addon1">
							<button style='font-size: 20px;' type="submit" class="btn btn-outline-success">搜尋</button>
						</div>
					</form>
				</td>
			</tr>
		</table>
        <?php
		include("connection.php");
		$result = mysqli_query($conn, $data);
		for ($i = 1; $i <= mysqli_num_rows($result); $i++) {
			$rs = mysqli_fetch_row($result);

			$sql1 = "SELECT * FROM video where video_id = $rs[1]";
			$result1 = mysqli_query($conn, $sql1);
				for ($k = 1; $k <= mysqli_num_rows($result1); $k++) {
					$da1 = mysqli_fetch_row($result1);

					$mem_name = "SELECT * FROM member where mem_phone = $da1[1]";
					$name = mysqli_query($conn, $mem_name);
						for ($j = 1; $j <= mysqli_num_rows($name); $j++) {
						$na = mysqli_fetch_row($name);

							$sql3 = "SELECT * FROM diet_plan where diet_plan_id = $da1[2]";
							$result3 = mysqli_query($conn, $sql3);
							for ($m = 1; $m <= mysqli_num_rows($result3); $m++) {
								$da2 = mysqli_fetch_row($result3);

							$sql2 = "SELECT * FROM video_msg where video_id = $rs[1]";
							$result2 = mysqli_query($conn, $sql2);
							$num = mysqli_num_rows($result2);
							
		?>

		<table class="" style="width: 700px; margin: 0 auto;padding: 0px;">
		
		<tr>
			<td><?php echo "<video width='700' height='300'  controls><source src='../video/$da1[0].mp4?$time' type='video/mp4'></video>"; ?></td>
		</tr>
	</table>
	<table style="width: 700px; margin: 0 auto;padding-top: 0px;">
	<tr>
			<td style="width: 150px;">
				<img src="public/mempicture/<?php echo $na[7].'?'.$time; ?>" style= "float:left;"  alt="" width="50px" height="50px" >
				<p style="font-size: 20px; float: left; padding-top: 10px;"><?php echo $na[2] ?></p>
			</td>
			<td style="width: 378px;">
								<p style="font-size: 20px; padding-top: 0px;"><?php echo $da2[1] ?></p>
								
				</td>
			<td>
				<p style="font-size: 20px;color:#8FBC8F; padding-top: 0px;"><?php echo $da1[15] ?></p>
			</td>

		</tr>
	</table>
	<table style="width: 700px; margin: 0 auto;padding: 0px">
						<tr>
							<td>
								<p style="font-size: 25px;font-weight:bold;"><?php echo $da1[3] ?></p>
							</td>
						</tr>
				</table>
	<table style="width: 700px; margin: 0 auto;padding-top: 0px;">
			<tr>
				<td>
					<?php
						if ($da1[1] == $mem_phone) {
					?>
							<a href='video_like_revise.php?id=<?php echo $da1[0]; ?>' style='font-size: 18px; float: left;' class='btn btn-outline-success'>修改影片資料</a>
							<a href='video_like_delet.php?id= <?php echo $rs[1]; ?>' style='font-size: 18px; float: left;' class='btn btn-outline-success' onclick="return confirm('確認刪除')">刪除影片</a>
					<?php
						}
					?>
				</td>
			</tr>
			<tr>
				<td>
					<div class="btn-group" role="group" aria-label="Basic example">
						<?php
							$like = "SELECT * FROM video_like where video_id = $rs[1] and mem_phone = $mem_phone";
							$v_like = mysqli_query($conn, $like);
							$nums = mysqli_num_rows($v_like);
							$nlike = "SELECT * FROM video_like where video_id = $rs[1]";
							$num_like = mysqli_query($conn, $nlike);
							$likenums = mysqli_num_rows($num_like);
							if ($nums > 0) {
								echo "<button type='button' class='btn btn-danger' id='btn_collect<?php echo $i; ?>' value='$rs[1]'>$likenums<img src='../picture/heart.png' width='30'></button>";
							} else {
								echo "<button type='button' class='btn btn-light' id='btn_collect<?php echo $i; ?>' value='$rs[1]'>$likenums<img src='../picture/heart.png' width='30'></button>";
							}
						?>
							<button type="button" class='btn btn-light'onclick="location.href='video_like_onemsg.php?id=<?php echo $rs[1]; ?>'"><?php echo $num; ?><img src="../picture/message.png" width="30"></button>
					</div>
				</td>
			</tr>
		</table>



	<hr style='background-color:black; height:1px; border:none; width:700px;'>
			</hr>
	<div>
					
		<?php
				}
			}
        }
	}
		?>
		</form>
	</div>
	</div>
	<div style="text-align: left">
	<div id="footer">
		<div>
			<span>110年專題組</span>
		</div>
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
				var id = '<?php echo $mem_phone; ?>';
				var v_id = $(this).val();
				var classname = $(this).attr("class");
				$(this).removeClass("btn btn-light btn btn-danger");
				if (classname == "btn btn-light") {
					$(this).addClass("btn btn-danger");
					alert("收藏成功");
					$.ajax({
						url: 'video_like_insert.php',
						type: 'POST',
						data: 'id=' + id + '&v_id=' + v_id,
						success: function(result) {
							console.log(result);
							location.reload();
						},
						error: function(xhr) {
							alert('Ajax request 發生錯誤');
						}
					});
				} else {
					$(this).addClass("btn btn-light");
					alert("取消收藏");
					$.ajax({
						url: 'video_like_del.php',
						type: 'POST',
						data: 'id=' + id + '&v_id=' + v_id,
						success: function(result) {
							console.log(result);
							location.reload();
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
