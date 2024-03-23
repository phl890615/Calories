<?php include_once("controller.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>熱力適攝</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>




<!DOCTYPE html>
<?php
$mem_email = $_SESSION['mem_email'];
$mem_pwd = $_SESSION['mem_pwd'];

if($mem_email != false && $mem_pwd != false){
    $query = "SELECT * FROM member WHERE mem_email = '$mem_email' AND mem_pwd = '$mem_pwd'";
    $run_query = mysqli_query($conn , $query);

}else{
    header('location: login.php');
}

//if($mem_email != false && $mem_pwd != false){
    //$query = "SELECT * FROM member WHERE mem_email = '$mem_email' AND mem_pwd = '$mem_pwd'";
    //$run_query = mysqli_query($conn , $query);
    //if($run_query){
        //$fetch_data = mysqli_fetch_assoc($run_query);
        //$mem_status = $fetch_data['mem_status'];
        //if($mem_status != "Verified"){
            //header("location: otp.php");
        //}
    //}
//}else{
    //header('location: login.php');
//}
?>
<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<title>熱力適攝</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
    <style>
		
		table{ border: 1px solid #050; }
		.fontb{ color:white;background:blue; }
		th { width: 40px; }
		td,th { height: 40px;text-align:center; }
		form { margin: 0px;padding: 0px; }
    </style>

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
        <body>
            <div align="center">
       <hr>
            <h1>體重紀錄</h1>
       <hr>
                    <div style="text-align: center">
    <?php
		require 'calendar.class.php';
		echo new Calendar;
		
    ?>
	
	<form style="width:1000px">
    <div class="row">
            <div class="col-md-5 offset-3">
 <?php
 
            $mem_phone = $_SESSION['mem_phone'];
            $sql = "SELECT mem_phone,mem_height,mem_weight,mem_bir,mem_gender FROM member WHERE mem_phone = '$mem_phone'";
            $result = mysqli_query($conn,$sql);
            $row = mysqli_fetch_assoc($result);
            
            $phone = $row['mem_phone'];
            
	    $sqls = "SELECT weight_record FROM weight WHERE mem_phone = '$phone' order by weight_day desc";
	    $results = mysqli_query($conn,$sqls);
		$rows = mysqli_fetch_assoc($results);
	    $nums=mysqli_num_rows($results);
		
	    if ($nums!=0)
		
		echo " <br><table style='display:inline;text-align:left; border:0;'><td style='display:inline;font-size: 24px;'>目前體重:".$rows['weight_record']." kg</td></table>" ;
			
			
            ?>
			<br>
</form>
</div>
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