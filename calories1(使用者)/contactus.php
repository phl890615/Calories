
<?php
    include_once("controller.php");
?>

<!DOCTYPE html>
            <!-- Website template by freewebsitetemplates.com -->
            <html>

            <head>

                <!-- Required meta tags -->
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
                

                <meta charset="UTF-8">
                <meta name="viewport" content="user-scalable=0, width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
                <title>熱力適攝</title>
                <link rel="stylesheet" type="text/css" href="css/style.css">
            </head>

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
            <h1>聯絡我們</h1>
       <hr>
       <div class="row">
            <div class="col-md-6 offset-3">
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="OFF">
        <?php
                        $mem_email = $_SESSION['mem_email'];
                        $sql = "SELECT * FROM member WHERE mem_email ='$mem_email'";

                        $gotResuslts = mysqli_query($conn,$sql);

                        if($gotResuslts){
                            if(mysqli_num_rows($gotResuslts)>0){
                                while($row = mysqli_fetch_array($gotResuslts)){
                                    
                                    ?>
                                    <!-- <div id="alert">All Inputs are required</div> -->
            

        <?php
            if(isset($_POST['send'])){
            $mem_email = $_POST['mem_email'];
            $subject = $_POST['subject'];
            $message = $_POST['message'];
            $sender = "g0987149050@gmail.com";
            
        if(empty($subject) || empty($message)){
            ?>
            <div id="alert" style="font-family: serif, sans-serif, cursive, fantasy, monospace; font-size: 18px;">必須輸入所有欄位</div>
            <?php
        }else{
            
            if(mail($sender,$subject,$message,$mem_email)){
                ?>
                <div id="alert " style="font-family: serif, sans-serif, cursive, fantasy, monospace; font-size: 18px;">訊息已經成功發送給 <br> <?php echo $sender ?></div>
                <?php
            }else{
                ?>
                <div id="alert" style="font-family: serif, sans-serif, cursive, fantasy, monospace; font-size: 18px;">發送郵件失敗<br>請檢查你的連接.</div>
                <?php
            }
        }
    }
    
    ?>  
    <form> 
    <br><div class="input-group mb-3">
                                    <label for="name" style="font-size: 24px;" class="col-sm-4 col-form-label">Email:</label>
                                    <input  type="email"style="font-size: 20px;" name="mem_email" class="form-control" readonly value="<?php echo $row['mem_email']; ?>" aria-label="Recipient's username" aria-describedby="basic-addon2"> 
                            </div>
    <br><div class="input-group mb-3">
                                    <label for="name"style="font-size: 24px;" class="col-sm-4 col-form-label" >主題:</label>
                                    <input type="text" style="font-size: 20px;"class="form-control" name="subject" placeholder="主題" aria-label="Recipient's username" aria-describedby="basic-addon2"> 
                            </div>    
    <br><div class="input-group mb-3">
                                    <label for="name" style="font-size: 24px;"class="col-sm-4 col-form-label" >內容:</label>
                                    <textarea name="message"  style="font-size: 20px;" class="form-control"  placeholder="在這裡輸入你的內容." aria-label="Recipient's username" aria-describedby="basic-addon2"></textarea>
                            </div>
            <br><div class="form-group">
                <input type="submit"  style="font-size: 20px;" class="btn btn-outline-success" name="send" value="發送">
                <input type="button" style="font-size: 20px;" name="cancel" onClick="location='membercentre.php'" class="btn btn-outline-success" value="取消">
            </div>
            </form> 
            <?php
            
   
        }
    }
}


        
    
            ?>
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