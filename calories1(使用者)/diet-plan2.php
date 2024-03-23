
<?php
    include("connection.php");

    session_start();
    $mem_phone = $_SESSION['mem_phone'];
    $sql = "SELECT * FROM member WHERE mem_phone = '$mem_phone'";
    $result = mysqli_query($conn,$sql);
    $test = mysqli_fetch_assoc($result);
    if ($test['diet_plan_id'] == ''){
        header("refresh:0;url=diet-plan1.php?");
        exit;
    }else{
        
?>

<!DOCTYPE html>
<html lang="en">

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>熱力適攝</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <!-- 這是最上方導覽列 -->
<?php
    $sql = "SELECT * FROM member WHERE mem_phone = '$mem_phone'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    $diet = $row['diet_plan_id'];
    $data = "SELECT * FROM diet_plan where diet_plan_id = $diet";
    $re = mysqli_query($conn,$data);
    $ro = mysqli_fetch_assoc($re);
?>

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
        <body>
            <div align="center">
       <hr>
            <h1>飲食計畫</h1>
       <hr>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="text-left">
                    
                </div>
                
                    <div class="form-group">
                    <form method="POST" action="diet-plan1.php">
                        <h1><select style="font-size: 20px;" class="form-control" name="diet" onchange="submit();"> 
                                <option value="" disabled selected hidden><?php echo $ro['diet_plan_sort']?></option> 
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
                        
                        
                        <?php
                            if($ro['diet_plan_sort']=="168間歇性斷食法"){
                                    echo "<h3 >用餐時間:</h3>";
                                    echo "
                                    <div class='input-group mb-3'>
                                         <td><label for='name' style='font-size: 20px;' class='col-md-5 col-form-label'>開始時間:</label><input type='time' style='font-size: 20px;' class='form-control' name='start' id='start' value='$row[mem_start]' required readonly></td>
                                         </div>
                                    <div class='input-group mb-3'>
                                         <td><label for='name' style='font-size: 20px;' class='col-md-5 col-form-label'>結束時間:</label><input type='time' style='font-size: 20px;'  class='form-control' name='end' id='end' value='$row[mem_end]' required readonly></td><br>
                                         </div>
                                         ";
                            }
                        ?>
                        <hr>
                           
                           <div class="input-group mb-3">
                                <label for="name"style="font-size: 20px;" class="col-md-5 col-form-label">每日消耗熱量:</label>
                                <input type="text" style="font-size: 20px;" class="form-control" value="<?php echo $row['mem_tdee']?>" readonly="readonly" aria-label="Recipient's username" aria-describedby="basic-addon2"> 
  <span class="input-group-text" style='font-size: 20px;' id="basic-addon2">卡</span>
</div>
                            <div class="input-group mb-3">
                                <label for="name" style="font-size: 20px;" class="col-md-5 col-form-label">預期體重:</label>
                                <input type="text" style="font-size: 20px;" class="form-control" value="<?php echo $row['mem_idealweight']?>" readonly="readonly" aria-label="Recipient's username" aria-describedby="basic-addon2"> 
  <span class="input-group-text" style='font-size: 20px;'id="basic-addon2">kg</span>
</div>
                            <div class="input-group mb-3">
                                <label for="name"  style="font-size: 20px;" class="col-md-5 col-form-label">預期減重時間:</label>
                                <input type="text" style="font-size: 20px;"  class="form-control" value="<?php echo $row['mem_idealdate']?>" readonly="readonly" aria-label="Recipient's username" aria-describedby="basic-addon2"> 
  <span class="input-group-text"style='font-size: 20px;' id="basic-addon2">天</span>
</div>
                            <div class="input-group mb-3">
                                <label for="name" style="font-size: 20px;" class="col-md-5 col-form-label">每日應攝取熱量:</label>
                                <input type="text" style="font-size: 20px;" class="form-control" value="<?php echo $row['mem_calor']?>" readonly="readonly" aria-label="Recipient's username" aria-describedby="basic-addon2"> 
  <span class="input-group-text" style='font-size: 20px;' id="basic-addon2">卡</span>
</div>
                            
                            
                            <hr>
                            
                            <h3 style=" float:left; width:200px;">飲食注意事項:</h3><br>
                            <?php
                            $calor = $row['mem_calor'];
                            $fat = floor($calor*0.7*100)/100;
                            $fat_gram = floor($fat/9*100)/100;
                            $protein = floor($calor*0.25*100)/100;
                            $protein_gram = floor($protein/4*100)/100;
                            $carbohydrate = floor($calor*0.05*100)/100;
                            $carbohydrate_gram = floor($carbohydrate/4*100)/100;
                            $breakfast = floor($calor/2*100)/100;
                            $lunch = floor($calor/4*100)/100;
                            $dinner = floor($calor/4*100)/100;
                                if($ro['diet_plan_sort']=="生酮飲食"){
                                    
                                    echo "<br><h5 style='float:left; color: #4b4b4b;
                                    font-family: serif, sans-serif, cursive, fantasy, monospace; width:410px;'> 每日攝取各項營養(由每日應攝取熱量計算):</h5><br>";
                                    echo "<br>
                                    <div class='input-group mb-3'>
                                    <label for='name' style='font-size: 20px;' class='col-md-5 col-form-label'>脂肪攝取約</label>
                                    <input type='text' style='font-size: 20px;' class='form-control' name='fat_gram' id='fat_gram' value='$fat_gram' readonly='readonly'  aria-label='Recipient's username' aria-describedby='basic-addon2'> 
                                    <span class='input-group-text'style='font-size: 20px;' id='basic-addon2'>克</span>
                                    </div> 
                                    <div class='input-group mb-3'>
                                    <label for='name' style='font-size: 20px;' class='col-md-5 col-form-label'>換算約</label>
                                    <input type='text' style='font-size: 20px;' name='fat' id='fat' class='form-control' value='$fat' readonly='readonly'   aria-label='Recipient's username' aria-describedby='basic-addon2'> 
                                    <span class='input-group-text' style='font-size: 20px;'id='basic-addon2'>卡</span>
                                    </div>
                                    <div class='input-group mb-3'>
                                    <label for='name' style='font-size: 20px;' class='col-md-5 col-form-label'>蛋白質攝取約</label>
                                    <input type='text' style='font-size: 20px;' class='form-control' name='protein_gram' id='protein_gram' value='$protein_gram' readonly='readonly'  aria-label='Recipient's username' aria-describedby='basic-addon2'> 
                                    <span class='input-group-text' style='font-size: 20px;'id='basic-addon2'>克</span> 
                                    </div> 
                                    <div class='input-group mb-3'>
                                    <label for='name' style='font-size: 20px;' class='col-md-5 col-form-label'>換算約</label>
                                    <input type='text' style='font-size: 20px;' name='protein' id='protein' class='form-control' value='$protein' readonly='readonly'   aria-label='Recipient's username' aria-describedby='basic-addon2'> 
                                    <span class='input-group-text' style='font-size: 20px;'id='basic-addon2'>卡</span>
                                    </div>
                                    <div class='input-group mb-3 '>
                                    <label for='name' style='font-size: 20px;' class='col-md-5 col-form-label'>碳水化合物攝取約</label>
                                    <input type='text' style='font-size: 20px;' class='form-control' name='carbohydrate_gram' id='carbohydrate_gram' value='$carbohydrate_gram' readonly='readonly'  aria-label='Recipient's username' aria-describedby='basic-addon2'> 
                                    <span class='input-group-text' style='font-size: 20px;'id='basic-addon2'>克</span> 
                                    </div> 
                                    <div class='input-group mb-3'>
                                    <label for='name' style='font-size: 20px;' class='col-md-5 col-form-label'>換算約</label>
                                    <input type='text' style='font-size: 20px;' name='carbohydrate' id='carbohydrate' class='form-control' value='$carbohydrate' readonly='readonly'   aria-label='Recipient's username' aria-describedby='basic-addon2'> 
                                    <span class='input-group-text' style='font-size: 20px;'id='basic-addon2'>卡</span>
                                    </div> ";      
                                          
                                }else if($ro['diet_plan_sort']=="三餐正確飲食"){
                                    
                                    echo "<br><h5 style='float:left; color: #4b4b4b;
                                    font-family: serif, sans-serif, cursive, fantasy, monospace; width:410px;' > 每日攝取各項營養(由每日應攝取熱量計算):</h5><br>";
                                    echo "
                                    <div class='input-group mb-3'>
                                    <label for='name' style='font-size: 20px;' class='col-md-8 col-form-label'>早餐建議時間：06:00~09:45,建議攝取約</label>
                                    <input type='text' style='font-size: 20px;'  name='breakfast' class='form-control' id='breakfast' value='$breakfast' readonly='readonly'  aria-label='Recipient's username' aria-describedby='basic-addon2'> 
      <span class='input-group-text' id='basic-addon2'>卡</span>
    </div>              
                                    <div class='input-group mb-3'>
                                    <label for='name' style='font-size: 20px;' class='col-md-8 col-form-label'>午餐建議時間：12:15~12:45,建議攝取約</label>
                                    <input type='text' style='font-size: 20px;' name='lunch' class='form-control' id='lunch' value='$lunch' readonly='readonly'  aria-label='Recipient's username' aria-describedby='basic-addon2'> 
      <span class='input-group-text' id='basic-addon2'>卡</span>
    </div>
                                    <div class='input-group mb-3'>
                                    <label for='name' style='font-size: 20px;' class='col-md-8 col-form-label'>晚餐建議時間：18:00~19:00,建議攝取約</label>
                                    <input type='text' style='font-size: 20px;' name='dinner' class='form-control' id='dinner' value='$dinner' readonly='readonly'  aria-label='Recipient's username' aria-describedby='basic-addon2'> 
      <span class='input-group-text' id='basic-addon2'>卡</span>
    </div>";
                                         
                                }
                            ?>
                            
                           
                            <div class="input-group mb-3" >
                                    
                                    <textarea name="diet_plan_sup" id="exampleFormControlTextarea1" style="font-size: 20px;" class="form-control" rows="5" readonly aria-label="Recipient's username" aria-describedby="basic-addon2"><?php echo $ro['diet_plan_sup']?></textarea>
                                    
                                </div>
                            <hr>
                        <h3 style="float:left;  ">建議食用食物:</h3><br><br>
                        <div style="width: 580px; text-align: left;" >
                        
                            <?php
                            include("connection.php");
                            $sql = "SELECT * FROM diet_food WHERE diet_plan_id ='$diet'";
                            $result = mysqli_query($conn,$sql);
                                if (!$result){
                                    die ('Invalid query: ' . mysqli_error());//返回帶有錯誤的描述字符
                                }
                                                                
                                $array = array();//@->抑制錯誤
                                while($row = @mysqli_fetch_assoc($result)){
                                    $temp = array($row['diet_food_id'],$row['diet_plan_id'],$row['diet_food_type'],$row['diet_food_items']);
                                    array_push($array,$temp);
                                }

                            //宣告9大類的array
                            $egg_arr = array();
                            $bean_arr = array();
                            $fish_arr = array();
                            $meat_arr = array();
                            $milk_arr = array();
                            $gluten_arr = array();
                            $vegetable_arr = array();
                            $fruit_arr = array();
                            $wine_arr = array();
                            //先將各個食物裝進array中
                            for($i=0; $i<sizeof($array);$i++){
                                if($array[$i][2]==0){
                                    array_push($egg_arr, $array[$i][3]);
                                }
                                else if($array[$i][2]==1){
                                    array_push($bean_arr, $array[$i][3]);
                                }
                                else if($array[$i][2]==2){
                                    array_push($fish_arr, $array[$i][3]);
                                }
                                else if($array[$i][2]==3){
                                    array_push($meat_arr, $array[$i][3]);
                                }
                                else if($array[$i][2]==4){
                                    array_push($milk_arr, $array[$i][3]);
                                }
                                else if($array[$i][2]==5){
                                    array_push($gluten_arr, $array[$i][3]);
                                }
                                else if($array[$i][2]==6){
                                    array_push($vegetable_arr, $array[$i][3]);
                                }
                                else if($array[$i][2]==7){
                                    array_push($fruit_arr, $array[$i][3]);
                                }
                                else if($array[$i][2]==8){
                                    array_push($wine_arr, $array[$i][3]);
                                }
                            }
                            
                            //根據9大類的array去組合出table
                            $max_arr_len = max(sizeof($egg_arr), sizeof($bean_arr), sizeof($fish_arr),sizeof($meat_arr),sizeof($milk_arr),sizeof($gluten_arr),sizeof($vegetable_arr),sizeof($fruit_arr),sizeof($wine_arr));
                            //$new_egg=$max_arr_len-$sizeof(egg_arr);
                            //$new
                            //sizeof->array裡面資料筆數
                            if (sizeof($egg_arr) != 0){
                                echo "<table style='display:inline;text-align:left;'><td style='display:inline;'>蛋類:</td>";
                                $egg = '';
                                for($i=0; $i < $max_arr_len; $i++){
                                    if(sizeof($egg_arr) > $i){
                                        $egg .= $egg_arr[$i].'、';
                                    }
                                }
                                $eggs = rtrim($egg, '、');
                                echo "<td style='display:inline;color:#000000;'>$eggs</td></table>";
                            }
                            if (sizeof($bean_arr) != 0){
                                echo "<br>
                                <table style='display:inline;text-align:left;'><td style='display:inline;'>豆類:</td>";
                                $bean = '';
                                for($i=0; $i < $max_arr_len; $i++){
                                    if(sizeof($bean_arr) > $i){
                                        $bean .= $bean_arr[$i].'、';
                                    }
                                }
                                $beans = rtrim($bean, '、');
                                echo "<td style='display:inline;color:#000000;'>$beans</td></table>";
                            }
                            if (sizeof($fish_arr) != 0){
                                echo "<br>
                                <table style='display:inline;text-align:left;'><td style='display:inline;'>魚類:</td>";
                                $fish ='';
                                for($i=0; $i < $max_arr_len; $i++){
                                    if(sizeof($fish_arr) > $i){
                                        $fish .= $fish_arr[$i].'、';
                                    }
                                }
                                $fishs = rtrim($fish, '、');
                                echo "<td style='display:inline;color:#000000;'>$fishs</td></table>";
                            }
                            if (sizeof($meat_arr) != 0){
                                echo "<br>
                                <table style='display:inline;text-align:left;'><td style='display:inline;'>肉類:</td></table>";
                                $meat = '';
                                for($i=0; $i < $max_arr_len; $i++){
                                    if(sizeof($meat_arr) > $i){
                                        $meat .= $meat_arr[$i].'、';
                                    }
                                }
                                $meats = rtrim($meat, '、');
                                echo "<table style='display:inline;color:#000000;'><td style='display:inline;'>$meats</td></table>";
                            }
                            if (sizeof($milk_arr) != 0){
                                echo "<br>
                                <table style='display:inline;text-align:left;'><td style='display:inline;'>奶類:</td>";
                                $milk = '';
                                for($i=0; $i < $max_arr_len; $i++){
                                    if(sizeof($milk_arr) > $i){
                                        $milk .= $milk_arr[$i].'、';
                                    }
                                }
                                $milks = rtrim($milk, '、');
                                echo "<td style='display:inline;color:#000000;'>$milks</td></table>";
                            }
                            if (sizeof($gluten_arr) != 0){
                                echo "<br>
                                <table style='display:inline;text-align:left;'><td style='display:inline;'>麩質類:</td>";
                                $gluten = '';
                                for($i=0; $i < $max_arr_len; $i++){
                                    if(sizeof($gluten_arr) > $i){
                                        $gluten .= $gluten_arr[$i].'、';
                                    }
                                }
                                $glutens = rtrim($gluten, '、');
                                echo "<td style='display:inline;color:#000000;'>$glutens</td></table>";
                            }
                            if (sizeof($vegetable_arr) != 0){
                                echo "<br>
                                <table style='display:inline;text-align:left;'><td style='display:inline;'>蔬菜類:</td>";
                                $veg = '';
                                for($i=0; $i < $max_arr_len; $i++){
                                    if(sizeof($vegetable_arr) > $i){
                                        $veg .= $vegetable_arr[$i].'、';
                                    }
                                }
                                $vegs = rtrim($veg, '、');
                                echo "<td style='display:inline;color:#000000;'>$vegs</td></table>";
                                }
                            if (sizeof($fruit_arr) != 0){
                                echo "<br>
                                <table style='display:inline;text-align:left;'><td style='display:inline;'>水果類:</td>";
                                $fruit = '';
                                for($i=0; $i < $max_arr_len; $i++){
                                    if(sizeof($fruit_arr) > $i){
                                        $fruit .= $fruit_arr[$i].'、';
                                    }
                                }
                                $fruits = rtrim($fruit, '、');
                                echo "<td style='display:inline;color:#000000;'>$fruits</td></table>";
                            }
                            if (sizeof($wine_arr) != 0){
                                echo "<br>
                                <table style='display:inline;text-align:left;'><td style='display:inline;'>酒類:</td>";
                                $wine = '';
                                for($i=0; $i < $max_arr_len; $i++){
                                    if(sizeof($wine_arr) > $i){
                                        $wine .= $wine_arr[$i].'、';
                                    }
                                }
                                $wines = rtrim($wine, '、');
                                echo "<td style='display:inline;color:#000000;'>$wines</td></table>";
                            }
                        ?>
                            
                        </form>
                    </form>
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
<?php
}
?>