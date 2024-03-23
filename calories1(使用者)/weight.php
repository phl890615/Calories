
<?php include_once("controller.php");?>
<?php
	$rdate=$_GET['rdate'];
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
		<div id="body">

		<div align="center">
       <hr>
            <h1>記錄體重</h1>
       <hr>
        <div class="row">
            <div class="col-md-6 offset-3">
		<form method = "post" action="tweight.php" autocomplete="off">
			
          <?php
            $mem_phone = $_SESSION['mem_phone'];
            $sql = "SELECT mem_phone,mem_height,mem_weight,mem_bir,mem_gender,mem_idealweight FROM member WHERE mem_phone = '$mem_phone'";
            $result = mysqli_query($conn,$sql);
        
            $row = mysqli_fetch_assoc($result);
			
			$sql1 = "SELECT weight_record FROM weight WHERE mem_phone = '$mem_phone' and weight_day='$rdate'";
            $result1 = mysqli_query($conn,$sql1);
			if (mysqli_num_rows($result1) != 0)
			{
				$row2 = mysqli_fetch_assoc($result1);
				$weight = $row2['weight_record'];
			}
			else
			{
				$weight = "";
			}
			
          ?>
           <form>
          <div class="form-group">
          		<input type="hidden" class="form-control" name="phone" value="<?php echo $row['mem_phone'];?>" readonly/>
		  </div>
		  <br><div class="input-group mb-3">
                                    <label for="name" style="font-size: 22px;" class="col-md-5 col-form-label">日期:</label>
                                    <input type="text" style="font-size: 20px;" class="form-control" name="rdate" value="<?php echo $rdate;?>" readonly aria-label="Recipient's username" aria-describedby="basic-addon2"> 
                            </div>
	<br><div class="input-group mb-3">
                                    <label for="name" style="font-size: 22px;" class="col-md-5 col-form-label">體重(kg):</label>
                                    <input type="number" style="font-size: 20px;" class="form-control" name="weight" value="<?php echo $weight;?>" placeholder="請輸入體重" step="1" required aria-label="Recipient's username" aria-describedby="basic-addon2"> 
                            </div>
	<br><div class="input-group mb-3">
                                    <label for="name" style="font-size: 22px;" class="col-md-5 col-form-label">預期體重(kg):</label>
                                    <input type="text" style="font-size: 20px;" class="form-control" name="hopeweight" value="<?php echo $row['mem_idealweight'];?>" readonly aria-label="Recipient's username" aria-describedby="basic-addon2"> 
                            </div>						
		  <br><div class="form-group mb-3">
          	<input type="button" style="font-size: 20px;" class="btn btn-outline-success" value="返回" onclick="history.back()"/>
            <input type="submit" style="font-size: 20px;" class="btn btn-outline-success" value="完成" /><br>
		  </div>
    </form>
    </div>
		</div>
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
