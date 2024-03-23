
<?php
    session_start();
    include("connection.php");
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
            <h1>會員資料</h1>
       <hr>
       
        <div class="row">
            <div class="col-md-6 offset-3">
                <?php
                if(isset($_GET['success'])){
                    if($_GET['success'] == 'userUpdated'){
                        ?>
                        <small class="alert alert-success"> 資料更新成功.</small>
                        <hr>
                        <?php
                    }
                }


                if(isset($_GET['error'])){

                    if($_GET['error'] == 'invalidFileType'){
                        ?>
                        <small class="alert alert-danger"> 文件類型無效，僅允許圖像.</small>
                        <hr>
                        <?php
                    }else if($_GET['error'] == 'invalidFileSize'){
                        ?>
                        <small class="alert alert-danger"> 允許最大 5mb 圖像大小.</small>
                        <hr>
                        <?php
                    }
                }
                ?>
                <form action="controller.php"
                      method="POST"
                      enctype="multipart/form-data">
                   
                      <?php
                    
                    $mem_phone = $_SESSION['mem_phone'];
                    $sql = "SELECT * FROM member WHERE mem_phone ='$mem_phone'";
                    $time = date('His', (time() + 7 * 3600));

                    $gotResuslts = mysqli_query($conn,$sql);

                    if($gotResuslts){
                        if(mysqli_num_rows($gotResuslts)>0){
                            while($row = mysqli_fetch_array($gotResuslts)){
                                //print_r($row['user_name']);
                                ?>
                                <div class="text-center">
                                <img src="public/mempicture/<?php echo $row['mem_picture'].'?'.$time; ?> " alt="" style="vertical-align:middle;"  
                                        width="200px" height="200px"><br>
                                        
                                    <br>
                            </div>
                                
                                
                                            
                            <form> 
                            <div class="input-group mb-3">
                                <label for="name"style="font-size: 24px;" class="col-sm-4 col-form-label">選擇頭像:</label>
                                <input  type="file" style="font-size: 20px;"  name="mem_picture" class="form-control" accept="image/*" multiple  value="<?php echo $row['mem_picture']; ?>" aria-label="Recipient's username" aria-describedby="basic-addon2"> 
                            </div> 
                                <div class="input-group mb-3">
                                    <label for="name" style="font-size: 24px;" class="col-sm-4 col-form-label">暱稱:</label>
                                    <input  type="text" style="font-size: 20px;" name="mem_name" class="form-control" required value="<?php echo $row['mem_name']; ?>" aria-label="Recipient's username" aria-describedby="basic-addon2"> 
                            </div>    
                                
                            <div class="input-group mb-3">
                                    <label for="name" style="font-size: 24px;" class="col-sm-4 col-form-label" >性別:</label>
                                    <div class="form-check form-check-inline">
                                    <input type="radio"  style="font-size: 20px;"  name="mem_gender" id="0" required  value="0"<?php echo $row['mem_gender']=="0" ? "checked":"" ?>>
                                    <label style="font-size: 20px;" class="form-check-label" for="0">男</label>
                                    </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" style="font-size: 20px;"   name="mem_gender" id="1" required  value="1"<?php echo $row['mem_gender']=="1" ? "checked":"" ?>>
                                    <label style="font-size: 20px;" class="form-check-label" for="1">女</label>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                <label for="name" style="font-size: 24px;" class="col-sm-4 col-form-label">生日:</label>
                                    <input  type="date" style="font-size: 20px;"  name="mem_bir" class="form-control" required value="<?php echo $row['mem_bir']; ?>" aria-label="Recipient's username" aria-describedby="basic-addon2"> 
                            </div> 
                                <div class="input-group mb-3">
                                <label for="name"style="font-size: 24px;"  class="col-sm-4 col-form-label">電話:</label>
                                <input  type="tel" style="font-size: 20px;"  name="mem_phone" class="form-control" readonly value="<?php echo $row['mem_phone']; ?>" aria-label="Recipient's username" aria-describedby="basic-addon2"> 
                            </div>     
                                <div class="input-group mb-3">
                                <label for="name" style="font-size: 24px;" class="col-sm-4 col-form-label">Email:</label>
                                <input  type="email" style="font-size: 20px;"  name="mem_email" class="form-control" readonly value="<?php echo $row['mem_email']; ?>" aria-label="Recipient's username" aria-describedby="basic-addon2"> 
                            </div>      
                                
                                        <div class="form-group">
                                            <input type="submit" style="font-size: 20px;"  name="update"  class="btn btn-outline-success" value="更新">
                                            <input type="button" style="font-size: 20px;"  name="cancel" onClick="location='membercentre.php'" class="btn btn-outline-success" value="取消">
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