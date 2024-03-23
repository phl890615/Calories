<?php
include("controller.php");
error_reporting(0);
include("connection.php");
$mem_phone = $_SESSION['mem_phone'];
$sql = "SELECT * FROM member WHERE mem_phone ='$mem_phone'";

$first = mysqli_query($conn, $sql);
for ($i = 1; $i <= mysqli_num_rows($first); $i++) {
    $fi = mysqli_fetch_row($first);
}
if($fi[9]==1){
    header("Location:blockade.php"); 
}else{
    echo "";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>熱力適攝</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<!DOCTYPE html>


<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	
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
        <div align="center">
		<div id="body">
       <hr>
            <h1>修改留言</h1>
       <hr>
                    <div style="text-align: center">
                        
</div>
                    <form method="post" action="videos_msgdel.php" style="width:700px" >
                        <input style='font-size: 22px;' type='hidden' name='msg_id' value="<?php echo $_GET['id'] ?>">
                        <div class="input-group mb-3">
						<label style='font-size: 22px;' class="input-group-text"  class="col-sm-4 col-form-label">修改留言:</label>
                            <input style='font-size: 20px;' type='text' class="form-control" name='msg_cont' value="<?php echo $_GET['msg'] ?>" required>
                        </div>  
						<div class="form-group mb-3">  
                        <input type='hidden' name='v_id' value="<?php echo $_GET['vid'] ?>">
                        <input type="submit" style='font-size: 20px;' name='update' class='btn btn-outline-success' value='更新'>
                        <input type="button" style='font-size: 20px;' name='' class='btn btn-outline-success' value='取消' onclick="location.href='video_onemsg.php?id=<?php echo $_GET['vid'] ?>'">
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
            </body>

            </html>