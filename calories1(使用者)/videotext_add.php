
<?php
include("controller.php");
include_once("connection.php");
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





<script type="text/javascript" src="js/get_data.js"></script>
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
		<div align="center">
		<div id="body">
       <hr>
            <h1>發佈影片</h1>
       <hr>
                    <div style="text-align: center">
          
        </div>
        
        <form action="text_add.php" method="post" name="form" style="width:700px">
            <div class="input-group mb-3">
            <label style='font-size: 19px;' class="input-group-text" for="name" class="col-sm-4 col-form-label">飲食法:</label>
                <select style='font-size: 19px; height:42.5px;' name="diet_id" class="form-control" id="inputGroupSelect01" required>
                    <option selected value="" > 選擇飲食法 </option>
                    <?php
                    include('connection.php');
                    $sql = "SELECT * FROM diet_plan";
                    $result = mysqli_query($conn, $sql);
                    $i = 1;
                    while ($i <= mysqli_num_rows($result)) {
                        $co = mysqli_fetch_row($result);
                        echo '<option value="', $co[0], '">', $co[1], '</option>';
                        $i++;
                    }
                    ?>
                </select>
            </div>
                    <?php
                    $mem_name = "SELECT * FROM member where mem_phone = $mem_phone";
                    $name = mysqli_query($conn, $mem_name);
                    for ($j = 1; $j <= mysqli_num_rows($name); $j++) {
                        $na = mysqli_fetch_row($name);
                    ?>
           
            <div class="input-group mb-3">
                <label style='font-size: 19px;' class="input-group-text" for="name" class="col-sm-4 col-form-label">發佈者:</label>
                <input style='font-size: 19px;' type="text" name="" value='<?php echo $na[2] ?>' class="form-control" aria-label="Recipient's username" aria-describedby="basic-addon2" readonly> 
                <input style='font-size: 19px;' type="hidden" name="phone" value='<?php echo $mem_phone ?>' class="form-control"  aria-describedby="basic-addon1">
            </div>
                    <?php
                    }
                    ?>
            <div class="input-group mb-3">
            <label style="font-size: 19px;"class="input-group-text" for="name" class="col-sm-4 col-form-label">影片標題:</label>
                <input style="font-size: 19px;" type="text" name="title" class="form-control" aria-label="Recipient's username" aria-describedby="basic-addon2" required>
            </div>

            <div class="input-group mb-3">
            <label style='font-size: 19px;'class="input-group-text" for="name" class="col-sm-4 col-form-label">影片簡介:</label>
                <textarea style='font-size: 19px;' name="cont" class="form-control" id="exampleFormControlTextarea1" rows="5" aria-label="Recipient's username" aria-describedby="basic-addon2" required></textarea>
            </div>

            <div class="input-group mb-3">
            <label style='font-size: 19px;'class="input-group-text" for="name" class="col-sm-4 col-form-label">影片食材:</label>
                <textarea style='font-size: 19px;' name="method" class="form-control" id="exampleFormControlTextarea1" rows="5" aria-label="Recipient's username" aria-describedby="basic-addon2" required></textarea>
            </div>

            <td><span style='font-size: 19px;' class="input-group-text" id="basic-addon1">影片餐期:</span></td>

            <table class="table table-borderless" style="width: 600px;margin:0 auto"  >
                <tr>
                <div class="form-check form-check-inline">
                <input style='font-size: 19px;' class="form-check-input" type="checkbox" name="select_item[]" value="早餐" id="flexCheckChecked" required>
                                <label class="form-check-label" for="inlineCheckbox1">早餐</label>
                            </div>
                <div style='font-size: 19px;' class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="select_item[]" value="午餐" id="flexCheckChecked" >
                                <label class="form-check-label" for="inlineCheckbox1">午餐</label>
                            </div>
                <div style='font-size: 19px;' class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="select_item[]" value="晚餐" id="flexCheckChecked" >
                                <label class="form-check-label" for="inlineCheckbox1">晚餐</label>
                            </div>
                <div style='font-size: 19px;' class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="select_item[]" value="點心" id="flexCheckChecked" >
                                <label class="form-check-label" for="inlineCheckbox1">點心</label>
                            </div>
                </tr>
            </table>

            <div class="input-group mb-3">
            <label style='font-size: 19px;' class="input-group-text" for="name" class="col-sm-4 col-form-label">飲食偏好:</label>
                <select style='font-size: 19px; height:42.5px;' name="fav" class="form-control" id="inputGroupSelect01" required>
                    <option selected value=""> 選擇偏好 </option>
                    <option value="0"> 全素 </option>
                    <option value="1"> 蛋奶素 </option>
                    <option value="2"> 葷食 </option>
                </select>
            </div>

            <td><span style='font-size: 19px;' class="input-group-text" id="basic-addon1">過敏類:</span></td>
           

            <table class="table table-striped">
                <tr>
                    <td>1.麩質類過敏:</td>
                    <td><input style='font-size: 19px;'type="radio" name="glut" value="1" required>是</td>
                    <td><input style='font-size: 19px;'type="radio" name="glut" value="0" >否</td>
                </tr>
                <tr>
                    <td>2.奶類過敏:</td>
                    <td><input style='font-size: 19px;'type="radio" name="milk" value="1" required>是</td>
                    <td><input style='font-size: 19px;'type="radio" name="milk" value="0" >否</td>
                </tr>
                <tr>
                    <td>3.甲殼類過敏:</td>
                    <td><input style='font-size: 19px;'type="radio" name="crust" value="1" required>是</td>
                    <td><input type="radio" name="crust" value="0" >否</td>
                </tr>
                <tr>
                    <td>4.魚類過敏:</td>
                    <td><input style='font-size: 19px;'type="radio" name="fish" value="1" required>是</td>
                    <td><input style='font-size: 19px;'type="radio" name="fish" value="0" >否</td>
                </tr>
                <tr>
                    <td>5.堅果類過敏:</td>
                    <td><input style='font-size: 19px;'type="radio" name="nut" value="1" required>是</td>
                    <td><input style='font-size: 19px;'type="radio" name="nut" value="0" >否</td>
                <tr>
                    <td>6.豆類過敏:</td>
                    <td><input style='font-size: 19px;'type="radio" name="bean" value="1" required>是</td>
                    <td><input style='font-size: 19px;'type="radio" name="bean" value="0" >否</td>
                </tr>
            </table>

            <div class="input-group mb-3">
            <label style='font-size: 19px;' class="input-group-text" for="name" class="col-sm-4 col-form-label">製作難度:</label>
                <select style='font-size: 19px; height:42.5px;' name="level" class="form-control" id="inputGroupSelect01" required>
                    <option selected value=""> 選擇難度 </option>
                    <option value="1"> 毫無難度 </option>
                    <option value="2"> 新手 </option>
                    <option value="3"> 正常 </option>
                    <option value="4"> 稍難 </option>
                    <option value="5"> 困難 </option>
                </select>
            </div>
        
            <div class="form-group">
            
                            </div>
            <div  style="text-align:right"><div style='font-size: 19px;'><input type=submit class="btn btn-outline-success" value='送出'></div></div>


        <br></form>
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