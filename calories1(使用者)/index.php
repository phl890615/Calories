<?php 
include_once("controller.php"); 
include_once("connection.php"); 
?>

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


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/get_data.js"></script>
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

            <div id="body" style='height:auto;'>

            <div align="center">
                <hr style='margin-top: 16px;margin-bottom: 16px;border: 0;border-top: 1px solid rgba(0,0,0,.1);'>
                <h1 style="font-family:serif,sans-serif,cursive,fantasy,monospace; color:#4b4b4b; margin:0 0 8px;">飲食法選擇</h1>
                <hr style="
    
    border: 0;
    border-top: 1px solid rgba(0,0,0,.1);">
    

    <div class="page-header">

        <select style='font-size: 20px; height:42.5px; font-weight:bold;' id="diet_plan" class="form-control">


            <option value="" style='font-size: 20px; font-weight:bold;' selected="selected" class="form-control">請選擇飲食法</option>




<?php
$sql = "SELECT diet_plan_id, diet_plan_sort, diet_plan_sum, diet_plan_adv, diet_plan_dis, diet_plan_food FROM diet_plan";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
while( $rows = mysqli_fetch_assoc($resultset) ) { 
?>
<option style='font-size: 20px; font-weight:bold;' class="form-control" value="<?php 
echo $rows["diet_plan_id"]; ?> "><?php echo $rows["diet_plan_sort"]; ?></option>
<?php }	?>
</select>
</h3>	
<table class="table table-striped hidden"
id="recordListing">

      <thead>
            <tr> 
                  <td  style="font-weight:bold; font-size: 24px; text-align:left;" >飲食法簡介:</td>
            </tr>
      </thead>
      <tbody>
        <tr>

            <td style='font-size: 20px; text-align:left;' id="dietplan_sum"></td>
            
        </tr>
      </tbody>
      <thead>
            <tr> 
                  <td style="font-weight:bold; font-size: 24px; text-align:left;">飲食法優點:</td>
            </tr>
      </thead>
      <tbody>
        <tr>

            <td style='font-size: 20px; text-align:left;' id="dietplan_adv"></td>
            
        </tr>
      </tbody>
      <thead>
            <tr> 
                  <td  style="font-weight:bold; font-size: 24px; text-align:left;">飲食法缺點:</td>  
            </tr>
      </thead>
      <tbody>
        <tr>
            
            <td style='font-size: 20px; text-align:left;' id="dietplan_dis"></td>
            
        </tr>
      </tbody>
      <thead>
            <tr> 
                  <td  style="font-weight:bold; font-size: 24px; text-align:left;">飲食法食物類型:</td>
            </tr>
      </thead>
      <tbody>
        <tr>
            
            <td style='font-size: 20px; text-align:left;' id="dietplan_food"></td>
            

        </tr>
      </tbody>

</table>


<br>
			
<div class="text-left" id="introduce">
                    <span style="font-weight:bold; font-size: 20px; text-align:left;" class="input-group-text" id="basic-addon1">歡迎使用熱力適攝，在這個網頁可以規畫使用者的飲食方法，讓使用者可以使用各種飲食法瘦身或達到更好的身體狀態。規畫完如果不知道有什麼料理是適合自己的話，我們也有很多使用者上傳的料理影片，裡面有許多料理做法，使用者可以跟著影片一步一步的做出美味的料理，也可以學習到這些料理的做法。請選擇一種飲食法觀看，內容會有簡介、優點、缺點、類型等等的介紹供使用者參考，可以依照需求選擇合適的飲食法來做飲食管理。</span>
                    
                    
                </div>     
                    


</div>
</div>



                <div id="footer">
                    <div>
                        <span style="font-family:serif,sans-serif,cursive,fantasy,monospace; font-size: 20px; color: #356618;">110年專題組</span>
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
<script>
                $(document).ready(function() {
                    $("#diet_plan").change(function() {
                        var diet_plan = $("#diet_plan").val();
                        if (diet_plan != '')
                            $("#introduce").hide();
                        else
                            $("#introduce").show();
                    });
                });
            </script>
            </body>

            </html>