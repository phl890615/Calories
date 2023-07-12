<!DOCTYPE html>
<html lang="en">
<script>
    function middle_level(){
        alert("中強度運動：快走、跳舞、園藝、家務、打獵、一般建築工作、搬運20公斤以下物品等...");
        }
    function high_level(){
        alert("高強度運動：跑步、爬山、爬山坡、騎自行車、有氧運動、快速游泳、競技運動、搬重物20公斤以上等...");
        }
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
			<a href="index.php" id="logo"><img src="images/logo.png" alt="Logo"></a>
			<ul>
				<li class="current">
					<a href="test.php">首頁</a>
				</li>
				<li>
					<a href="membercentre.php">會員中心</a>
					<ul>
						<li>
							<a href="userprofile.php">會員資料</a>
						</li>
						<li>
							<a href="contactus.php">聯絡我們</a>
						</li>
						<li>
							<a href="changepassword.php">修改密碼</a>
						</li>
						<li>
							<a href="tdee.php">Tdee</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="weightrecord.php">體重記錄</a>
				</li>
				<li>
					<a href="diet-plan1.php">飲食計畫</a>
				</li>
				<li>
					<a href="video_view.php">影片中心</a>
				</li>
				<li>
					<a href="logout.php">登出</a>
				</li>
			</ul>
		</div>
		<div id="body">


<body>

<h2 align="center">TDEE</h2><br />
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
    include("connection.php");
    include("controller.php");
    
    $mem_phone = $_SESSION['mem_phone'];
    $sql = "SELECT * FROM member WHERE mem_phone = '$mem_phone'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    $riqi= $row['mem_bir'];;
    $uriqi=strtotime($riqi);      //將日期轉化為時間戳
    $age=getAge($uriqi);
?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="text-center">
                
                </div>
                <div class="cal26rd">
                    <h5 class="card-title mt-3 ml-4 text-muted"></h5>
                    <div class="card-body">
                    <form method="POST" action="tdeeadd.php">
                        <h1>基本資料</h1>
                            <form method="POST" action="">
                            <input type="hidden" name="phone" id="phone" value="<?php echo $row['mem_phone']?>" required readonly="readonly">
                            身高:<input type="number" name="height" id="height" value="<?php echo $row['mem_height'];?>" placeholder="請輸入身高" step="0.1"/required>cm<br>
                            <br>
                            體重:<input type="number" name="weight" id = "weight"  value="<?php echo $row['mem_weight'];?>" placeholder="請輸入體重" step="0.1"/required>kg<br>
                            <br>
                            <label for="birthday">生日:</label>
                                <input type="date" name="birthday" id="birthday" value="<?php echo $row['mem_bir'];?>" required>
                                <input type="hidden" name="age" id="age" value="<?php echo $age?>" required readonly="readonly">
                                <br>
                            <label for="gender">性別:</label>
                                <input type="hidden" name="gen" id="gen" value="<?php echo $row['mem_gender']?>" required readonly="readonly">
                                <input type="radio" name="gender" id = "gender" value="0"required <?php if($row['mem_gender']==0) echo "checked";?>/>男
                                <input type="radio" name="gender" id = "gender" value="1"required <?php if($row['mem_gender']!=0) echo "checked";?>/>女
                            <br>
          
                        <h1>每周運動量</h1>
                            中強度(3~6METs):<input type="text" name="mid" id="mid" placeholder="請輸入每周該運動的總分鐘數"/> 分鐘 <input type="button" name="button" value="中強度運動類別" class="btn btn-outline-primary" onclick="middle_level()" /><br>
                            <br>
                            高強度(大於6METs):<input type="text" name="high" id="high"  placeholder="請輸入每周該運動的總分鐘數"/> 分鐘 <input type="button" name="button" value="高強度運動類別" class="btn btn-outline-primary" onclick="high_level()" /><br>
                            <br>
                            <input class="btn btn-outline-primary" type="button" value="計算" onclick ="compute()"/><br>
                        
                            <br>
                            <input type="hidden" name="sports" id="sports" value="<?php echo $row['mem_exercise'];?>" required readonly="readonly">
                            <br>
                            基礎代謝率:<input type="text" name="BMR" id="BMR" value="<?php echo $row['mem_bmr'];?>" readonly="readonly"><br>
                            <br>
                            每日消耗熱量(TDEE):<input type="text" name="TDEE" id="TDEE" value="<?php echo $row['mem_tdee'];?>" readonly="readonly"><br>
                            <br>
                            <input class="btn btn-outline-primary" type="submit" name="com" value="儲存" />
                        </form>
                    </form>
                    <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html> 