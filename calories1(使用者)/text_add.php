<?php
include('connection.php');
date_default_timezone_set("Asia/Taipei");
$date = date("Y-m-d H:i:s");
$str_tag = "";
$tag = $_POST['select_item'];
$per = implode(',', $tag);
$sql = "INSERT INTO video (
mem_phone,
diet_plan_id,
video_title,
video_cont,
video_method,
video_period,
video_fav,
video_allergy_glut,
video_allergy_milk,
video_allergy_crust,
video_allergy_fish,
video_allergy_nut,
video_allergy_bean,
video_level,
video_time) VALUES (
'$_POST[phone]',
'$_POST[diet_id]',
'$_POST[title]',
'$_POST[cont]',
'$_POST[method]',
'$per',
'$_POST[fav]',
'$_POST[glut]',
'$_POST[milk]',
'$_POST[crust]',
'$_POST[fish]',
'$_POST[nut]',
'$_POST[bean]',
'$_POST[level]',
'$date')";
if (!mysqli_query($conn, $sql)) {
	die('請把資料輸入完整');
}
//echo "<script>alert('請上傳影片');</script>";
echo "<script>alert_video();</script> ";
mysqli_close($conn)
?>
<?php
include('connection.php');
$sql = "SELECT * FROM video";
$result = mysqli_query($conn, $sql);
$i = 1;
while ($i <= mysqli_num_rows($result)) {
	$co = mysqli_fetch_row($result);
	$i++;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>熱力適攝</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
</head>

<!DOCTYPE html>

<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<html>

<head>
	<meta charset="UTF-8">
	<title>熱力適攝</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
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
		<!-- Button trigger modal -->
		<button type="button" id="alert2" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" hidden>

		</button>

		<!-- Modal -->
		<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="staticBackdropLabel" style="text-align:left;font-size: 28px;font-family:serif,sans-serif,cursive,fantasy,monospace;">提醒</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body" style="text-align:left;font-size: 20px;font-family:serif,sans-serif,cursive,fantasy,monospace;">
						確定要新增嗎？
					</div>
					<div class="modal-footer">
						<button type="button" id="add_3" class="btn btn-secondary" data-bs-dismiss="modal">確定</button>
						
					</div>
				</div>
			</div>
		</div>

		<!-- alert_video -->
		<button type="button" id="form" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop2" hidden>

		</button>

		<!-- Modal -->
		<div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="staticBackdropLabel" style="text-align:left;font-size: 28px;font-family:serif,sans-serif,cursive,fantasy,monospace;">提醒</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body" style="text-align:left;font-size: 20px;font-family:serif,sans-serif,cursive,fantasy,monospace;">
						請上傳影片
					</div>
					<div class="modal-footer">
						<button type="button"  class="btn btn-secondary" data-bs-dismiss="modal">確定</button>
						
					</div>
				</div>
			</div>
		</div>

		<div align="center">
			<div id="body">
				<hr>
				<h1>上傳影片</h1>
				<hr>
				<div style="text-align: center">
				</div>
				<form action="video_add.php" method="POST" enctype="multipart/form-data" style="width:700px">
					<div class="input-group mb-3">

						<input style='font-size: 19px;' type="hidden" name="diet_id" readonly="readonly" value="<?php echo $co[0]; ?>" class="form-control" aria-label="Recipient's username" aria-describedby="basic-addon2">
					</div>
					<div style='font-size: 19px;' class="input-group mb-3">
						<label style='font-size: 19px;' class="input-group-text" for="name" class="col-sm-4 col-form-label">選擇檔案:</label>
						<input style='font-size: 19px;' type="file" name="video_id[]" class="form-control" id="inputGroupFile02" accept=".mp4" onchange="checkfile(this);" multiple required>
					</div>

					<div class="form-group">
						<input style='font-size: 19px;' id="add_1" type="button" class="btn btn-outline-success" value="新增">
						<input style='font-size: 19px;' id="add" type="submit" name="submit" class="btn btn-outline-success" value="新增" hidden>
						<input style='font-size: 19px;' type="button" class="btn btn-outline-success" value="取消" onclick="location.href='<?php echo "video_del.php?id=" . $co[0] ?>'">
					</div>

				</form>






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
				<script type="text/javascript">
					$(document).ready(function() {
						$("#form").click();

						$("#add_1").click(function() {
							$("#alert2").click();
						});

						$("#add_3").click(function() {
							$("#add").click();
						});
					});
				</script>
</body>

</html>
<script type="text/javascript" language="javascript">
function checkfile(sender) {

  // 可接受的附檔名
  var validExts = new Array(".mp4");

  var fileExt = sender.value;
  fileExt = fileExt.substring(fileExt.lastIndexOf('.'));
  if (validExts.indexOf(fileExt) < 0) {
    alert("檔案類型錯誤，可接受的副檔名有：" + validExts.toString());
    sender.value = null;
    return false;
  }
  else return true;
}
</script>