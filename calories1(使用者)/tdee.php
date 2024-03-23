

<?php
include("connection.php");
include("controller.php");
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
<html lang="en">
<script>
    function compute(){
        var height = document.getElementById('height').value;
        var weight = document.getElementById('weight').value;
        var age = document.getElementById('age').value;
        var gen = document.getElementById('gen').value;
        var mid = document.getElementById('mid').value;
        var high = document.getElementById('high').value;
        var sports = (mid*1) + (high*2);
        if(gen==0){
            var BMR = (10*weight) + (6.25*height) - (5*age) + 1*5;
            if(sports*1 > 1260){
                var spr = 4;
                var TDEE = 1.9 * BMR;    
            }else if(sports*1 > 900){
                var spr = 3;
                var TDEE = 1.725 * BMR;
            }else if(sports*1 > 360){
                var spr = 2;
                var TDEE = 1.55 * BMR;
            }else if(sports*1 > 90){
                var spr = 1;
                var TDEE = 1.375 * BMR;
            }else{
                var spr = 0;
               var TDEE = 1.2 * BMR; 
            }
        }else{
            var BMR = (10*weight) + (6.25*height) - (5*age) - 1*161;
            if(sports*1 > 1260){
                var spr = 4;
                var TDEE = 1.9 * BMR;    
            }else if(sports*1 > 900){
                var spr = 3;
                var TDEE = 1.725 * BMR;
            }else if(sports*1 > 360){
                var spr = 2;
                var TDEE = 1.55 * BMR;
            }else if(sports*1 > 90){
                var spr = 1;
                var TDEE = 1.375 * BMR;
            }else{
                var spr = 0;
               var TDEE = 1.2 * BMR; 
            }
        }
        document.getElementById("sports").value=spr;
        document.getElementById("BMR").value=BMR;
        document.getElementById("TDEE").value=TDEE;
    }   
</script>

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
       
       <div style="text-align:center;"><h1>每日消耗熱量(TDEE)</h1></div>
       <hr>
    <!-- 這是最上方導覽列 -->
<?php
    function getAge($birthday){
    //格式化出生時間年月日
    $byear=date('Y',$birthday);
    $bmonth=date('m',$birthday);
    $bday=date('d',$birthday);
    //格式化當前時間年月日
    $tyear=date('Y');
    $tmonth=date('m');
    $tday=date('d');
    //開始計算年齡
    $age=$tyear-$byear;
        if($bmonth>$tmonth || $bmonth==$tmonth && $bday>$tday){
            $age--;
        }
        return $age;
    }
    
    
    $mem_phone = $_SESSION['mem_phone'];
    $sql = "SELECT * FROM member WHERE mem_phone = '$mem_phone'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    $riqi= $row['mem_bir'];;
    $uriqi=strtotime($riqi);      //將日期轉化為時間戳
    $age=getAge($uriqi);
?>
<div align="center">
    
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="text-center">
                
                </div>
                <div class="cal26rd">
                    
                    <form method="POST" action="tdeeadd.php">
                        <h3>基本資料</h3>
                            <form method="POST" action="">
                            <input type="hidden" name="phone" id="phone" value="<?php echo $row['mem_phone']?>" required readonly="readonly">
                            
                            <div class="input-group mb-3">
                                <label for="name" style="font-size: 22px;"class="col-md-5 col-form-label">身高(cm):</label>
                                <input type="number" style="font-size: 20px;" name="height"  class="form-control" id="height" value="<?php echo $row['mem_height'];?>" placeholder="請輸入身高" step="0.1" required aria-label="Recipient's username" aria-describedby="basic-addon2"> 
                            </div> 
                            
                            <div class="input-group mb-3">
                                <label for="name" style="font-size: 22px;" class="col-md-5 col-form-label">體重(kg):</label>
                                <input type="number" style="font-size: 20px;" name="weight" class="form-control" id = "weight"  value="<?php echo $row['mem_weight'];?>" placeholder="請輸入體重" step="0.1" required aria-label="Recipient's username" aria-describedby="basic-addon2"> 
                            </div>       
                            
                            <div class="input-group mb-3">
                                <label for="name" style="font-size: 22px;"class="col-md-5 col-form-label">生日:</label>
                                <input type="date" style="font-size: 20px;" name="birthday" class="form-control" id="birthday" readonly value="<?php echo $row['mem_bir'];?>" required aria-label="Recipient's username" aria-describedby="basic-addon2"> 
                                <input type="hidden" name="age" id="age" value="<?php echo $age?>" required readonly="readonly">
                            </div>
                            
                            <div class="input-group mb-3">
                                <label for="name" style="font-size: 22px;" class="col-md-5 col-form-label">性別:</label>
                                <input type="hidden" name="gen" id="gen" value="<?php echo $row['mem_gender']?>" required readonly="readonly" aria-label="Recipient's username" aria-describedby="basic-addon2"> 
                                <input type="text" style="font-size: 20px;" name="gender" id = "gender" class="form-control" value="<?php if($row['mem_gender']==0){ echo "男";}else{echo "女";}?>" required readonly="readonly">
                            </div>       
                            
                            <hr>
                            
                            <div class="">
                            <span style="font-size:28px;color:#4b4b4b;
		font-family:serif,sans-serif,cursive,fantasy,monospace;margin-left:110px">每周運動量</span>
                        <input type="button" style="float:right;font-size: 20px;" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#exampleModal" value="運動類別" >

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"  style="text-align:left;font-size: 20px; font-family:serif,sans-serif,cursive,fantasy,monospace;" id="exampleModalLabel">運動類別介紹</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="關閉"></button>
                            </div>
                            <div class="modal-body" style="text-align:left;font-size: 20px;font-family:serif,sans-serif,cursive,fantasy,monospace;" >
                            中強度運動:快走、跳舞、園藝、家務、打獵、一般建築工作、搬運20公斤以下物品等...<br><hr>
                            高強度運動:跑步、爬山、爬山坡、騎自行車、有氧運動、快速游泳、競技運動、搬重物20公斤以上等...
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
                            </div>
                            </div>
                        </div>
                        </div>

                        <h1></h1>
                                <div class="input-group mb-3">
                                <label for="name" style=" font-size: 22px;"class="col-md-5 col-form-label">中強度(3~6METs):</label>
                                <input type="text" style="font-size: 20px;" name="mid" class="form-control" id="mid" placeholder="請輸入每周該運動的總分鐘數" aria-label="Recipient's username" aria-describedby="basic-addon2"> 
                                <span class="input-group-text" id="basic-addon2">分鐘</span>
                                </div>
             
                            <div class="input-group mb-3">
                                <label for="name"style="font-size: 22px;" class="col-md-5 col-form-label">高強度(大於6METs):</label>
                                <input type="text" name="high" style="font-size: 20px;" id="high" class="form-control" placeholder="請輸入每周該運動的總分鐘數" aria-label="Recipient's username" aria-describedby="basic-addon2"> 
  <span class="input-group-text" id="basic-addon2">分鐘</span>
</div>
                        

                            <div class="form-group">
                                <input class="btn btn-outline-success" style="float:right; font-size: 20px;" type="button" value="計算" onclick ="compute()"/><br>
                            </div>
                            <hr>
                            <input type="hidden" name="sports" id="sports" value="<?php echo $row['mem_exercise'];?>" required readonly="readonly">
                            
                            <h3>計算結果</h3>
                            <div class="input-group mb-3">
                                <label for="name" style="font-size: 22px;"class="col-md-5 col-form-label">基礎代謝率:</label>
                                <input type="text" style="font-size: 20px;" name="BMR" class="form-control" id="BMR" value="<?php echo $row['mem_bmr'];?>" readonly="readonly" aria-label="Recipient's username" aria-describedby="basic-addon2"> 
  <span class="input-group-text" id="basic-addon2">卡</span>
</div>

                            <div class="input-group mb-3">
                                <label for="name" style="font-size: 22px;"class="col-md-5 col-form-label"> 每日消耗熱量(TDEE):</label>
                                <input type="text" style="font-size: 20px;" name="TDEE" class="form-control" id="TDEE" value="<?php echo $row['mem_tdee'];?>" readonly="readonly" aria-label="Recipient's username" aria-describedby="basic-addon2"> 
  <span class="input-group-text" id="basic-addon2">卡</span>
</div>
                            
                            <div class="form-groupmb-3">
                                <input class="btn btn-outline-success"style="float:right;font-size: 20px;"  type="submit" name="com" value="儲存" />
                                <br>
                                
                                </div>
                                </div>
                                </div>

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