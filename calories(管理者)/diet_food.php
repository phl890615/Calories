<?php
session_start();
if ($_SESSION['Name']=='manager'){
	
}else{
	header("refresh:0;url=manager.php");
}
?>
<script type="text/javascript">
    function check() {
        var egg = $("#egg").val();
        var bean = $("#bean").val();
        var fish = $("#fish").val();
        var meat = $("#meat").val();
        var milk = $("#milk").val();
        var glut = $("#glut").val();
        var vege = $("#vege").val();
        var fruit = $("#fruit").val();
        var wine = $("#wine").val();
        var checkbox = document.getElementsByName("checkbox[]");
        var food = [];
        for(k in checkbox){
            if(checkbox[k].checked == true){
                food.push(checkbox[k].value);
            }
        }
        if (egg || bean || fish || meat || milk || glut|| vege || fruit || wine || food.length != 0) {
            return true;
        }else {
            alert('請輸入值或勾選預刪除之食物');
            return false;
        }
    }
</script>
<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<html>

<head>
	
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">

	<meta charset="UTF-8">
	<meta name="viewport" content="user-scalable=0, width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<title>熱力適攝</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type='text/javascript' src='js/mobile.js'></script>
</head>
<body>
    <div id="header">
		<h1><a href="index.html">WELCOME<span>熱力適攝</span></a></h1>
		<ul id="navigation">
			<li class="current">
				<a href="index.php">首頁</a>
			</li>
            <li>
				<a href="user.php">會員管理</a>
			</li>
			<li>
				<a href="video_view.php">影片管理</a>
                <ul>
					<li>
						<a href="videotext_add.php">管理者新增影片</a>
					</li>
				</ul>
			</li>
			<li>
				<a href="diet_plan.php">飲食法管理</a>
			</li>
			<li>
				<a href="video_msg.php">留言管理</a>
			</li>
            <li>
				<a href="logout.php">登出</a>
			</li>
		</ul>
	</div>
    <div id="body" style='background:linear-gradient(#9CD98C, #457349); '>
        <div style="text-align: center">
			<h2>推薦食物</h2>
		</div>
        <form method="POST" action="diet_foodadd.php" onsubmit="return check()">
        <table style=''>
            <?php
            include("connect.php");
            $id = $_GET['id'];
            $sql = "SELECT * FROM diet_food WHERE diet_plan_id ='$id'";
            $result = mysqli_query($link,$sql);
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
            echo  "<table style='background-color:white' class='table table-striped ;table table-hover ;'>";
            //sizeof->array裡面資料筆數
            echo "<tr>
                    <td style='width:100px;'> 蛋類 </td>
                    <td style='width:120px;'><input style='width:60px;height:30px; ' type ='text' name='egg' id = 'egg'> <input style= ' color:#3a70f2; border-radius:4px; border:1px solid #3a70f2; font-size:18px;' type='submit' name='add' value='+' /></td>";
            for($i=0; $i < $max_arr_len; $i++){
                if(sizeof($egg_arr) > $i){
                    echo "<td style='width:100px;'><input type='checkbox' name='checkbox[]' value='$egg_arr[$i]' />$egg_arr[$i]</td>";
                }else {
                    echo "<td style='width:100px;'></td>";
                }
            }
            "</tr>";
                            
            echo "<tr>
                    <td style='width:100px;'> 豆類 </td>
                    <td style='width:100px;'><input style='width:60px;height:30px; ' type ='text' name='bean' id = 'bean'> <input style= ' color:#3a70f2; border-radius:4px; border:1px solid #3a70f2; font-size:18px;' type='submit' name='add' value='+' /></td>";
            for($i=0; $i < $max_arr_len; $i++){
                if(sizeof($bean_arr) > $i){
                    echo "<td style='width:100px;'><input type='checkbox' name='checkbox[]' value='$bean_arr[$i]' />$bean_arr[$i]</td>";
                }else {
                    echo "<td style='width:100px;'></td>";
                }
            }
            "</tr>";
                            
            echo "<tr>
                    <td style='width:100px;'> 魚類 </td>
                    <td style='width:100px;'><input style='width:60px;height:30px; ' type ='text' name='fish' id = 'fish'> <input style= ' color:#3a70f2; border-radius:4px; border:1px solid #3a70f2; font-size:18px;' type='submit' name='add' value='+' /></td>";
            for($i=0; $i < $max_arr_len; $i++){
                if(sizeof($fish_arr) > $i){
                    echo "<td style='width:100px;'><input type='checkbox' name='checkbox[]' value='$fish_arr[$i]' />$fish_arr[$i]</td>";
                }else {
                    echo "<td style='width:100px;'></td>";
                }
            }
            "</tr>";
                            
            echo "<tr>
                    <td style='width:100px;'> 肉類 </td>
                    <td style='width:100px;'><input style='width:60px;height:30px; ' type ='text' name='meat' id = 'meat'> <input style= ' color:#3a70f2; border-radius:4px; border:1px solid #3a70f2; font-size:18px;' type='submit' name='add' value='+' /></td>";
            for($i=0; $i < $max_arr_len; $i++){
                if(sizeof($meat_arr) > $i){
                    echo "<td style='width:100px;'><input type='checkbox' name='checkbox[]' value='$meat_arr[$i]' />$meat_arr[$i]</td>";
                }else {
                    echo "<td style='width:100px;'></td>";
                }
            }
            "</tr>";
                            
            echo "<tr>
                    <td style='width:100px;'> 奶類 </td>
                    <td style='width:100px;'><input style='width:60px;height:30px; ' type ='text' name='milk' id = 'milk'> <input style= ' color:#3a70f2; border-radius:4px; border:1px solid #3a70f2; font-size:18px;' type='submit' name='add' value='+' /></td>";
            for($i=0; $i < $max_arr_len; $i++){
                if(sizeof($milk_arr) > $i){
                    echo "<td style='width:100px;'><input type='checkbox' name='checkbox[]' value='$milk_arr[$i]' />$milk_arr[$i]</td>";
                }else {
                    echo "<td style='width:100px;'></td>";
                }
            }
            "</tr>";
                            
            echo "<tr>
                    <td style='width:100px;'> 麩質類 </td>
                    <td style='width:100px;'><input style='width:60px;height:30px; ' type ='text' name='glut' id = 'glut'> <input style= ' color:#3a70f2; border-radius:4px; border:1px solid #3a70f2; font-size:18px;' type='submit' name='add' value='+' /></td>";
            for($i=0; $i < $max_arr_len; $i++){
                if(sizeof($gluten_arr) > $i){
                    echo "<td style='width:100px;'><input type='checkbox' name='checkbox[]' value='$gluten_arr[$i]' />$gluten_arr[$i]</td>";
                }else {
                    echo "<td style='width:100px;'></td>";
                }
            }
            "</tr>";
                            
            echo "<tr>
                    <td style='width:100px;'> 蔬菜類 </td>
                    <td style='width:100px;'><input style='width:60px;height:30px; ' type ='text' name='vege' id = 'vege'> <input style= ' color:#3a70f2; border-radius:4px; border:1px solid #3a70f2; font-size:18px;' type='submit' name='add' value='+' /></td>";
            for($i=0; $i < $max_arr_len; $i++){
                if(sizeof($vegetable_arr) > $i){
                    echo "<td style='width:100px;'><input type='checkbox' name='checkbox[]' value='$vegetable_arr[$i]' />$vegetable_arr[$i]</td>";
                }else {
                    echo "<td style='width:100px;'></td>";
                }
            }
            "</tr>";
                            
            echo "<tr >
                    <td style='width:100px;'> 水果類 </td>
                    <td style='width:100px;'><input style='width:60px;height:30px; ' type ='text' name='fruit' id = 'fruit'> <input style= ' color:#3a70f2; border-radius:4px; border:1px solid #3a70f2; font-size:18px;' type='submit' name='add' value='+' /></td>";
            for($i=0; $i < $max_arr_len; $i++){
                if(sizeof($fruit_arr) > $i){
                    echo "<td style='width:100px;'><input type='checkbox' name='checkbox[]' value='$fruit_arr[$i]' />$fruit_arr[$i]</td>";
                }else {
                    echo "<td style='width:100px;'></td>";
                }
            }
            "</tr>";
                            
            echo "<tr>
                    <td style='width:100px;'> 酒類 </td>
                    <td style='width:100px;'><input style='width:60px;height:30px; ' type ='text' name='wine' id = 'wine'> <input style= ' color:#3a70f2; border-radius:4px; border:1px solid #3a70f2; font-size:18px;' type='submit' name='add' value='+' /></td>";
            for($i=0; $i < $max_arr_len; $i++){
                if(sizeof($wine_arr) > $i){
                    echo "<td style='width:100px;'><input type='checkbox' name='checkbox[]' value='$wine_arr[$i]' />$wine_arr[$i]</td>";
                }else {
                    echo "<td style='width:100px;'></td>";
                }
            }
            "</tr>";
    ?>
        <input type="hidden" name="id" id="id" value="<?php echo $id?>" required >
        </table>
        <br />
        <div >
            <input type="button" name="Submit" value="返回" class="btn btn-success" onclick="location.href='diet_plan.php?sort=<?php echo $id?>'"/>
            <input class="btn btn-success" type="submit" name="del" value="刪除" onclick = "return confirm('確認刪除');"/>
        </div>
    </form>
</div>
	<div id="footer">
		<div>
			<span>110年專題組</span>
		</div>
	</div>
</body>
</html>