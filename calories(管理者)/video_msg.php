<?php
session_start();
if ($_SESSION['Name']=='manager'){
	
}else{
	header("refresh:0;url=manager.php");
}
?>
<script type="text/javascript">
	function checkAll() {
		var hobby = document.getElementsByClassName("hobby");
		for (var i = 0; i < hobby.length; i++) {
			var h = hobby[i];
			h.checked = true;
		}

	}

	function unCheckAll() {
		var hobby = document.getElementsByClassName("hobby");
		for (var i = 0; i < hobby.length; i++) {
			var h = hobby[i];
			h.checked = false;

		}
	}
	function check() {
        var checkbox = document.getElementsByName("checkbox[]");
        var msg = [];
        for(k in checkbox){
            if(checkbox[k].checked == true){
                msg.push(checkbox[k].value);
            }
        }
        if (msg.length != 0) {
            return true;
        }else {
            alert('請勾選預刪除訊息');
            return false;
        }
    }
</script>
<?php
if (isset($_POST['search']) != '') {
	$search = $_POST['search'];
	$sql = "select * from video_msg where mem_phone LIKE '%" . $search . "%' or video_msg_cont LIKE '%" . $search . "%' order by video_msg_id desc";
} else {
	$sql = "select * from video_msg order by video_msg_id desc";
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
			<h2>留言管理</h2>
		</div>
		<form id="form1" name="form1" method="post" action="" >
			<div class="input-group mb-3">
				<span class="input-group-text" style="border-color:#6DC757;border-width:3px;background-color:#6AAD58" id="basic-addon1" >請輸入留言:</span>
				<input class="form-control" style="border-color:#6DC757;border-width:3px;background-color:transparent;" style="resize:none" name="search" type="text" required>
				<input class="btn btn-success" style="border-color:#6DC757;border-width:3px" type='submit' name='button' value='查詢' />
			</div>

		</form>
		<form method="POST" action="video_msgdel.php" onsubmit="return check()">
			<table class="table table-striped ;table table-hover" style='background-color:white'>
				<div>
					<input class="btn btn-success" type="button" style="margin-right: 3%;" value="全選" onclick="checkAll()" />
					<input class="btn btn-success" type="button" value="取消全選" onclick="unCheckAll()" />
				</div>
				<br />
				<br />
				<?php
				include("connect.php");
				$result = mysqli_query($link, $sql);
				$i = 1;
				while ($i <= mysqli_num_rows($result)) {
					$co = mysqli_fetch_row($result);
					$mem_name = "select * from member where mem_phone = $co[2]";
					$name = mysqli_query($link, $mem_name);
					for ($j = 1; $j <= mysqli_num_rows($name); $j++) {
						$na = mysqli_fetch_row($name);
				?>
						<tr>
							<td><input class="hobby" type="checkbox" name="checkbox[]" value="<?php echo $co[0] ?>" /></td>
							<td><?php 
									if($co[2]=='0900000000'){
										echo "<a style='color:green;padding;'>$na[2]</a>";
									}else{
										echo "<a href='userselect.php?phone=$co[2]'>$na[2]</a>";
									}
								?>
							</td>
							<td><?php echo $co[3] ?></td>
							<td><?php echo $co[4] ?></td>
					<?php
						$i++;
					}
				}
					?>
						</tr>
			</table>
			<br />
			<div>
				<div style="text-align:right"><input type=submit class="btn btn-success" name='del' value='刪除' onclick="return confirm('確認刪除');"></div>
			</div>
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