<?php
include('connect.php');
date_default_timezone_set("Asia/Taipei");
$date = date("Y-m-d H:i:s");
$str_tag = "";
$tag = $_POST['select_item'];
if(isset($tag)==""){
	echo "<script>alert('資料請輸入完整');history.go(-1);</script>";
}
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
if (!mysqli_query($link, $sql)) {
	die("<script>alert('資料請輸入完整');history.go(-1);</script>");
	
}
echo "<script>alert('請上傳影片');</script>";
mysqli_close($link)
?>
<?php
include('connect.php');
$sql = "SELECT * FROM video";
$result = mysqli_query($link, $sql);
$i = 1;
while ($i <= mysqli_num_rows($result)) {
	$co = mysqli_fetch_row($result);
	$i++;
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
		<form action="video_add.php" method="POST" enctype="multipart/form-data">
			<div class="input-group mb-3">
				<input type="hidden" name="diet_id" value="<?php echo $co[0];?>" class="form-control" aria-describedby="basic-addon1">
			</div>

			<div class="input-group mb-3">
				<input type="file" name="video_id[]" class="form-control" id="inputGroupFile02" accept=".mp4" onchange="checkfile(this);" multiple required>
			</div>

			<input type="submit" class="btn btn-success" name="submit" value="新增" onclick="return confirm('確定要新增嗎?')">
			<input type="button" class="btn btn-success" value="取消新增" onclick="location.href='<?php echo "video_del.php?id=" . $co[0] ?>'">
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