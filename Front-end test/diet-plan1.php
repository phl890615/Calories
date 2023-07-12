<!DOCTYPE html>
<html lang="en">
<script>
    function compute(){
        var idealweight = document.getElementById('idealweight').value;
        var idealdate = document.getElementById('idealdate').value;
        var weight = document.getElementById('weight').value;
        var tdee = document.getElementById('tdee').value;
        var lower = (weight*1) - (idealweight*1);
        var calorieintake = (tdee*1) - ((7700*lower)/idealdate);
        document.getElementById("lower").value=lower;
        document.getElementById("calorieintake").value=calorieintake.toFixed(2);
    }   
</script>


        
<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<title>Garden Walkthrough Website Template</title>
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
    <!-- 這是最上方導覽列 -->
<?php
    //include("connection.php");
    //include("controller.php");
    
    $mem_phone = '0911111111';
    $sql = "SELECT * FROM member WHERE mem_phone = '$mem_phone'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    if(isset($_POST['diet'])!='' ){
        $diet = $_POST['diet'];
        $data = "SELECT * FROM diet_plan where diet_plan_id = $diet";
    }else{
        $data = "SELECT * FROM diet_plan";
    }
    $re = mysqli_query($conn,$data);
    $ro = mysqli_fetch_assoc($re);
?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="text-center">
                    <h2>每日消耗熱量(TDEE)</h2><br />
                </div>
                <div class="cal26rd">
                    <h5 class="card-title mt-3 ml-4 text-muted"></h5>
                    <div class="card-body">
                    <form id="form1" name="form1" method="post" action="">
                        <h1><select name="diet" onchange="submit();"> 
                                <option value="<?php if(isset($_POST['diet'])!='' ){
                                                        echo $ro['diet_plan_id'];
                                                     }else{
                                                        echo "";
                                                     }?>">
                                                <?php if(isset($_POST['diet'])!='' ){
                                                        echo $ro['diet_plan_sort'];
                                                     }else{
                                                        echo "---請選擇---";
                                                     }?></option> 
                                <?php
                                    include('connection.php');
                                    $sql = "SELECT * FROM diet_plan";
                                    $result = mysqli_query($conn, $sql);
                                    $i=1;
                                    while($i <=mysqli_num_rows($result)){
                                        $co = mysqli_fetch_row($result);
                                        echo '<option value="' ,$co[0] ,'">', $co[1], '</option>';
                                        $i++;
                                    }   
                                ?>
                                </select></h1>
                        </form>
                        <br>
                        <form method="POST" action="diet-plan1add.php">
                        <?php 
                            if(isset($_POST['diet'])!='' ){
                                $diet = $_POST['diet'];
                                $data = "SELECT * FROM diet_plan where diet_plan_id = $diet";
                                $se = mysqli_query($conn,$data);
                                $ss = mysqli_fetch_assoc($se);
                                $start = @$row['mem_start'];
                                $end = @$row['mem_end'];
                                if($ss['diet_plan_sort']== "168間歇性斷食法" ){
                                    echo "<td>預期用餐時間：</td><br>
                                         <br>
                                         <td>開始時間：<input type='time' name='start' id='start' value='$start' required></td>
                                         <td>結束時間：<input type='time' name='end' id='end' value='$end' required></td><br>
                                         <br>";
                                }
                            }
                        ?>
                        <input type="hidden" name="diet" id="diet" value="<?php echo $diet?>" required readonly="readonly">
                        <div class="form-group">
                            <td>每日消耗熱量：<input type="text"  class="form-control"  value="<?php echo $row['mem_tdee'] ?>" readonly="readonly" 卡 </td><br>
                        </div>
                            <div class="form-group">
                                <td><input class="btn btn-info" type="button" value="TDEE" onclick ="location.href='tdee.php'"/></td><br>
                            </div>
                            <br>
                            <form method="POST" action="">
                            <input type="hidden" name="tdee" id="tdee" value="<?php echo $row['mem_tdee']?>" required readonly="readonly">
                            <h1>預期設定：</h1>
                            <input type="hidden" name="weight" id="weight" value="<?php echo $row['mem_weight']?>" required readonly="readonly">
                            <div class="form-group">
                                預期體重：<input type="text" name="idealweight" class="form-control" id="idealweight" value="<?php echo $row['mem_idealweight']?>"/> KG 
                            </div>
                            <div class="form-group">
                                預期減重時間：<input type="text" name="idealdate" class="form-control" id="idealdate" value="<?php echo $row['mem_idealdate']?>" onblur="if(this.value<30){alert('請至少輸入30天！');this.value=30;this.focus();}"/> 天 , *時間最少30天<br>
                            </div>
                            <div class="form-group">
                                <input class="btn btn-info" type="button" value="計算" onclick ="compute()"/><br>
                            </div>
                            <div class="form-group">
                                減重： <input type="text" name="lower" class="form-control" id="lower" value="<?php echo $row['mem_lower']?>" readonly="readonly" /> KG <br>
                            </div>
                            <br>
                            <div class="form-group">
                                每日應攝取熱量：<input type="text" name="calorieintake" class="form-control" id="calorieintake" value="<?php echo $row['mem_calor']?>" readonly="readonly"/> 卡 <br>
                            </div>
                            <br>
                                
                        <h1>飲食偏好：</h1>
                            <br>
                            <?php 
                                $fav = $row['mem_fav'];
                                if($fav==2){
                                    $fav = "葷食";
                                }else if($fav==1){
                                    $fav = "蛋奶素";
                                }else{
                                    $fav = "素食";
                                }
                            ?>
                            <select name="fav"> 
                                <option value="<?php echo $row['mem_fav']?>"><?php echo $fav?></option> 
                                <option value="2">葷食</option>
                                <option value="1">蛋奶素</option>
                                <option value="0">全素</option>
                            </select>
                            <br>
                        <h1>過敏：</h1>
                            <br>
                            <td><input type='checkbox' name='glut' value='1' <?php if($row['mem_allergy_glut']==1) echo "checked";?> />麩質類</td>
                            <td><input type='checkbox' name='milk' value='1'  <?php if($row['mem_allergy_milk']==1) echo "checked";?>/>奶類</td>
                            <td><input type='checkbox' name='crust' value='1'  <?php if($row['mem_allergy_crust']==1) echo "checked";?> />甲殼類</td>
                            <td><input type='checkbox' name='fish' value='1'  <?php if($row['mem_allergy_fish']==1) echo "checked";?> />魚類</td>
                            <td><input type='checkbox' name='nut' value='1'  <?php if($row['mem_allergy_nut']==1) echo "checked";?> />堅果類</td>
                            <td><input type='checkbox' name='bean' value='1'  <?php if($row['mem_allergy_bean']==1) echo "checked";?> />豆類</td><br>
                            <br>
                            <input class="btn btn-outline-primary" type="submit" name="com" value="下一步" />
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