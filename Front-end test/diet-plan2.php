<?php
    $mem_phone = "0911111111";
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
<script>
    function compute(){
        var calor = document.getElementById('calor').value;
        var fat = calor*0.7;
        var protein = calor*0.25;
        var carbohydrate = calor*0.05;
        var fat_gram = fat/9;
        var protein_gram = protein/4 ;
        var carbohydrate_gram = carbohydrate/4;
        var breakfast = calor/2;
        var lunch = calor/4;
        var dinner = calor/4;
        document.getElementById("fat").value=fat.toFixed(2);
        document.getElementById("protein").value=protein.toFixed(2);
        document.getElementById("carbohydrate").value=carbohydrate.toFixed(2);
        document.getElementById("fat_gram").value=fat_gram.toFixed(2);
        document.getElementById("protein_gram").value=protein_gram.toFixed(2);
        document.getElementById("carbohydrate_gram").value=carbohydrate_gram.toFixed(2);
        document.getElementById("breakfast").value=breakfast.toFixed(2);
        document.getElementById("lunch").value=lunch.toFixed(2);
        document.getElementById("dinner").value=dinner.toFixed(2);
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
    $sql = "SELECT * FROM member WHERE mem_phone = '$mem_phone'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    $diet = $row['diet_plan_id'];
    $data = "SELECT * FROM diet_plan where diet_plan_id = $diet";
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
                    <form method="POST" action="diet-plan1.php">
                        <h1><select name="diet" onchange="submit();"> 
                                <option value="" ><?php echo $ro['diet_plan_sort']?></option> 
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
                        <br>
                        <input type="hidden" name="calor" id="calor" value="<?php echo $row['mem_calor']?>" required readonly="readonly">
                            <td>每日消耗熱量：<?php echo $row['mem_tdee']?> 卡 </td><br>
                            <td>預期體重：<?php echo $row['mem_idealweight']?> KG </td><br>
                            <td>預期減重時間：<?php echo $row['mem_idealdate']?> 天 </td><br>
                            <td>每日應攝取熱量：<?php echo $row['mem_calor']?> 卡 </td><br>
                            <br>
                            <form method="POST" action="">
                            <h1>飲食注意事項：</h1>
                            <?php
                                if($ro['diet_plan_sort']=="生酮飲食"){
                                    echo "<br><input class='btn btn-outline-primary' type='button' value='計算' onclick ='compute()'/><br>";
                                    echo "<br> 每日攝取各項營養(由每日應攝取熱量計算)：";
                                    echo "<br>
                                            <td>脂肪攝取約</td> <td><input type='text' name='fat_gram' id='fat_gram' value='' readonly='readonly' /> 克 ，</td> <td ><input type='text' name='fat' id='fat' value='' readonly='readonly' /> 卡 </td>
                                          <br>
                                            <td>蛋白質攝取約</td> <td><input type='text' name='protein_gram' id='protein_gram' value='' readonly='readonly' /> 克 ，</td> <td ><input type='text' name='protein' id='protein' value='' readonly='readonly' /> 卡 </td>
                                          <br>
                                            <td>碳水化合物攝取約</td> <td><input type='text' name='carbohydrate_gram' id='carbohydrate_gram' value='' readonly='readonly' /> 克 ，</td> <td ><input type='text' name='carbohydrate' id='carbohydrate' value='' readonly='readonly' /> 卡 </td><br>";
                                }else if($ro['diet_plan_sort']=="三餐正確飲食"){
                                    echo "<input type='hidden' name='fat_gram' id='fat_gram' value='' readonly='readonly' /><input type='hidden' name='fat' id='fat' value='' readonly='readonly' />
                                         <input type='hidden' name='protein_gram' id='protein_gram' value='' readonly='readonly' /><input type='hidden' name='protein' id='protein' value='' readonly='readonly' /><input type='hidden' name='carbohydrate_gram' id='carbohydrate_gram' value='' readonly='readonly' /><input type='hidden' name='carbohydrate' id='carbohydrate' value='' readonly='readonly' />";
                                    echo "<br><input class='btn btn-outline-primary' type='button' value='計算' onclick ='compute()'/><br>";
                                    echo "<br> 每日攝取各項營養(由每日應攝取熱量計算)：";
                                    echo "<br>
                                            <td>早餐建議時間：6:00~9:45</td> , 建議攝取約 <td ><input type='text' name='breakfast' id='breakfast' value='' readonly='readonly' /> 卡 </td>
                                          <br>
                                            <td>午餐建議時間：12:15~12:45</td> , 建議攝取約 <td ><input type='text' name='lunch' id='lunch' value='' readonly='readonly' /> 卡 </td>
                                          <br>
                                            <td>晚餐建議時間：18:00~19:00</td> , 建議攝取約 <td ><input type='text' name='dinner' id='dinner' value='' readonly='readonly' /> 卡 </td><br>";
                                }
                            ?>
                            <br>
                            <td><?php echo $ro['diet_plan_sup']?> </td><br>
                            <br>
                        <h1>建議食用食物：</h1>
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
                                echo "<td style='width:100px;'>蛋類：</td>";
                                $egg = '';
                                for($i=0; $i < $max_arr_len; $i++){
                                    if(sizeof($egg_arr) > $i){
                                        $egg .= $egg_arr[$i].'、';
                                    }
                                }
                                $eggs = rtrim($egg, '、');
                                echo "<td style='width:100px;'>$eggs</td>";
                            }
                            if (sizeof($bean_arr) != 0){
                                echo "<br>
                                        <td style='width:100px;'>豆類：</td>";
                                $bean = '';
                                for($i=0; $i < $max_arr_len; $i++){
                                    if(sizeof($bean_arr) > $i){
                                        $bean .= $bean_arr[$i].'、';
                                    }
                                }
                                $beans = rtrim($bean, '、');
                                echo "<td style='width:100px;'>$beans</td>";
                            }
                            if (sizeof($fish_arr) != 0){
                                echo "<br>
                                        <td style='width:100px;'>魚類：</td>";
                                $fish ='';
                                for($i=0; $i < $max_arr_len; $i++){
                                    if(sizeof($fish_arr) > $i){
                                        $fish .= $fish_arr[$i].'、';
                                    }
                                }
                                $fishs = rtrim($fish, '、');
                                echo "<td style='width:100px;'>$fishs</td>";
                            }
                            if (sizeof($meat_arr) != 0){
                                echo "<br>
                                        <td style='width:100px;'>肉類：</td>";
                                $meat = '';
                                for($i=0; $i < $max_arr_len; $i++){
                                    if(sizeof($meat_arr) > $i){
                                        $meat .= $meat_arr[$i].'、';
                                    }
                                }
                                $meats = rtrim($meat, '、');
                                echo "<td style='width:100px;'>$meats</td>";
                            }
                            if (sizeof($milk_arr) != 0){
                                echo "<br>
                                        <td style='width:100px;'>奶類：</td>";
                                $milk = '';
                                for($i=0; $i < $max_arr_len; $i++){
                                    if(sizeof($milk_arr) > $i){
                                        $milk .= $milk_arr[$i].'、';
                                    }
                                }
                                $milks = rtrim($milk, '、');
                                echo "<td style='width:100px;'>$milks</td>";
                            }
                            if (sizeof($gluten_arr) != 0){
                                echo "<br>
                                        <td style='width:100px;'>麩質類：</td>";
                                $gluten = '';
                                for($i=0; $i < $max_arr_len; $i++){
                                    if(sizeof($gluten_arr) > $i){
                                        $gluten .= $gluten_arr[$i].'、';
                                    }
                                }
                                $glutens = rtrim($gluten, '、');
                                echo "<td style='width:100px;'>$glutens</td>";
                            }
                            if (sizeof($vegetable_arr) != 0){
                                echo "<br>
                                        <td style='width:100px;'>蔬菜類：</td>";
                                $veg = '';
                                for($i=0; $i < $max_arr_len; $i++){
                                    if(sizeof($vegetable_arr) > $i){
                                        $veg .= $vegetable_arr[$i].'、';
                                    }
                                }
                                $vegs = rtrim($veg, '、');
                                echo "<td style='width:100px;'>$vegs</td>";
                                }
                            if (sizeof($fruit_arr) != 0){
                                echo "<br>
                                        <td style='width:100px;'>水果類：</td>";
                                $fruit = '';
                                for($i=0; $i < $max_arr_len; $i++){
                                    if(sizeof($fruit_arr) > $i){
                                        $fruit .= $fruit_arr[$i].'、';
                                    }
                                }
                                $fruits = rtrim($fruit, '、');
                                echo "<td style='width:100px;'>$fruits</td>";
                            }
                            if (sizeof($wine_arr) != 0){
                                echo "<br>
                                        <td style='width:100px;'>酒類：</td>";
                                $wine = '';
                                for($i=0; $i < $max_arr_len; $i++){
                                    if(sizeof($wine_arr) > $i){
                                        $wine .= $wine_arr[$i].'、';
                                    }
                                }
                                $wines = rtrim($wine, '、');
                                echo "<td style='width:100px;'>$wines</td>";
                            }
                        ?>
                            <br>
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
<?php
}
?>