
<?php
$time = date('His', (time() + 7 * 3600));
include("controller.php");
$mem_phone = $_SESSION['mem_phone'];
$sql = "SELECT * FROM member WHERE mem_phone ='$mem_phone'";

$id = $_GET['id'];
include("connection.php");
$sql = "SELECT * FROM video WHERE video_id = '$id'";
$result = mysqli_query($conn, $sql);
for ($i = 1; $i <= mysqli_num_rows($result); $i++) {
    $rs = mysqli_fetch_row($result);
    $sql = "SELECT * FROM diet_plan where diet_plan_id = $rs[2]";
    $res = mysqli_query($conn, $sql);
    for ($X = 1; $X <= mysqli_num_rows($res); $X++) {
        $co = mysqli_fetch_row($res);

        $mem_name = "SELECT * FROM member where mem_phone = $rs[1]";
        $name = mysqli_query($conn, $mem_name);
        for ($j = 1; $j <= mysqli_num_rows($name); $j++) {
            $na = mysqli_fetch_row($name);

            $vmsg = "SELECT * FROM video_msg where video_id = $rs[0]";
            $msg = mysqli_query($conn, $vmsg);
            $num = mysqli_num_rows($msg);
            if ($rs[7] == 0) $get_fav = "素食";
            if ($rs[7] == 1) $get_fav = "蛋奶素";
            if ($rs[7] == 2) $get_fav = "葷食";
            if ($rs[8] == 1) $get_glut = "麩質、";
            else $get_glut = "";
            if ($rs[9] == 1) $get_milk = "奶類、";
            else $get_milk = "";
            if ($rs[10] == 1) $get_crust = "甲殼類、";
            else $get_crust = "";
            if ($rs[11] == 1) $get_fish = "魚類、";
            else $get_fish = "";
            if ($rs[12] == 1) $get_nut = "堅果類、";
            else $get_nut = "";
            if ($rs[13] == 1) $get_bean = "豆類";
            else $get_bean = "";
            if ($rs[14] == 1) {
                $get_level = "毫無難度";
            } elseif ($rs[14] == 2) {
                $get_level = "新手";
            } elseif ($rs[14] == 3) {
                $get_level = "正常";
            } elseif ($rs[14] == 4) {
                $get_level = "稍難";
            } else {
                $get_level = "困難";
            }
?>

<script type="text/javascript">
	function check() {
        var checkbox = document.getElementsByName("checkbox[]");
        var msg = [];
        for(k in checkbox){
            if(checkbox[k].checked == true){
                msg.push(checkbox[k].value);
            }
        }
        if (msg.length != 0) {
            return true;
        }else {
            alert('請勾選預刪除訊息');
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
                <script type='text/javascript' src='js/mobile.js'></script>
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
                

                
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
            <h1>影片留言及檢視
            </h1>
       <hr>
                    <div style="text-align: center; width: 700px;" >
                    
                    <td>
                    <img src="public/mempicture/<?php echo $na[7].'?'.$time; ?>" style= "float:left;"  alt="" width="100px" height="100px" >
						<span  style="font-size: 30px; float: left; padding-top: 25px;"><?php echo $na[2] ?></span><br><br>
                        
					</td><br><br>
                    <form  style="width: 700px; margin: 0 auto;padding: 0px;font-family:微軟正黑體;">
                    <div class="input-group mb-3">
                                <label style='font-size: 19px;' class="input-group-text" for="name" class="col-sm-4 col-form-label">影片標題:</label>
                                <input style='font-size: 19px;' type="text"  readonly="readonly" value="<?php echo $rs[3] ?>" class="form-control" aria-label="Recipient's username" aria-describedby="basic-addon2"> 
                            </div>
                    <div class="input-group mb-3">
                                <label style='font-size: 19px;' class="input-group-text" for="name" class="col-sm-4 col-form-label">飲食法:</label>
                                <input style='font-size: 19px;' type="text"  readonly="readonly" value="<?php echo $co[1] ?>" class="form-control" aria-label="Recipient's username" aria-describedby="basic-addon2"> 
                            </div>
                    <div class="input-group mb-3">
                                <label style='font-size: 19px;' class="input-group-text" for="name" class="col-sm-4 col-form-label">影片簡介:</label>
                                <textarea style='font-size: 19px;' name="cont" readonly="readonly" class="form-control" id="exampleFormControlTextarea1"  rows="4" aria-label="Recipient's username" aria-describedby="basic-addon2" ><?php echo $rs[4] ?></textarea>
                                
                            </div>
                    <div class="input-group mb-3">
                                <label style='font-size: 19px;' class="input-group-text" for="name" class="col-sm-4 col-form-label">影片食材:</label>
                                <textarea style='font-size: 19px;' name="cont" readonly="readonly" class="form-control" id="exampleFormControlTextarea1"  rows="4" aria-label="Recipient's username" aria-describedby="basic-addon2" ><?php echo $rs[5] ?></textarea>
                                
                            </div>
                    <div class="input-group mb-3">
                                <label style='font-size: 19px;' class="input-group-text" for="name" class="col-sm-4 col-form-label">影片餐期:</label>
                                <input style='font-size: 19px;' type="text"  readonly="readonly" value="<?php echo $rs[6] ?>" class="form-control" aria-label="Recipient's username" aria-describedby="basic-addon2"> 
                            </div>
                    <div class="input-group mb-3">
                                <label style='font-size: 19px;' class="input-group-text" for="name" class="col-sm-4 col-form-label">飲食偏好:</label>
                                <input style='font-size: 19px;' type="text"  readonly="readonly" value="<?php echo $get_fav ?>" class="form-control" aria-label="Recipient's username" aria-describedby="basic-addon2"> 
                            </div>
                            <div class="input-group mb-3">
                                <label style='font-size: 19px;' class="input-group-text" for="name" class="col-sm-4 col-form-label">過敏類:</label>
                                <input style='font-size: 19px;' type="text"  readonly="readonly" value="<?php echo $get_glut ?><?php echo $get_milk ?><?php echo $get_crust ?><?php echo $get_fish ?><?php echo $get_nut ?><?php echo $get_bean ?>" class="form-control" aria-label="Recipient's username" aria-describedby="basic-addon2"> 
                            </div>
                    <div class="input-group mb-3">
                                <label style='font-size: 19px;'class="input-group-text" for="name" class="col-sm-4 col-form-label">製作難度:</label>
                                <input style='font-size: 19px;' type="text"  readonly="readonly" value="<?php echo $get_level ?>" class="form-control" aria-label="Recipient's username" aria-describedby="basic-addon2"> 
                            </div>
                    <div class="input-group mb-3">
                                <label style='font-size: 19px;' class="input-group-text" for="name" class="col-sm-4 col-form-label">上傳時間:</label>
                                <input style='font-size: 19px;' type="text"  readonly="readonly" value="<?php echo $rs[15] ?>" class="form-control" aria-label="Recipient's username" aria-describedby="basic-addon2"> 
                            </div>
                            <hr>
        </form>
        
                        <td><?php echo "<video width='700'  controls><source src='../video/$rs[0].mp4?$time' type='video/mp4'></video>"; ?></td>
                        
                        <form method='post' action='video_msginsert.php' style="width:700px; text-align: center;" >
                        <?php
                        $sql = "SELECT * FROM member WHERE mem_phone ='$mem_phone'"; 
                        $first = mysqli_query($conn, $sql);
                        for ($i = 1; $i <= mysqli_num_rows($first); $i++) {
                            $fi = mysqli_fetch_row($first);
                        }
                        if($fi[9]==1){
                            echo"
                            <div class='input-group mb-3'>
                                <input style='font-size: 19px;' type='text' name='msg' placeholder='您已違反規定無法使用本功能，如果有任何問題請聯絡我們。' class='form-control' aria-label='Username' aria-describedby='basic-addon1' readonly='readonly'>
                                <input style='font-size: 19px;' type='hidden' name='phone' value='$mem_phone'>
                                <input style='font-size: 19px;' type='hidden' name='video_id' value='$rs[0]'>
                                <button style='font-size: 19px;' type='submit' class='btn btn-outline-success btn-lg' disabled>新增</button>
                            </div>
                    </form>" ;
                        }else{
                            echo "
                            <div class='input-group mb-3'>
                                <input style='font-size: 19px;' type='text' name='msg' placeholder='請輸入留言...' class='form-control' aria-label='Username'  required aria-describedby='basic-addon1'>
                                <input style='font-size: 19px;' type='hidden' name='phone' value='$mem_phone'>
                                <input style='font-size: 19px;' type='hidden' name='video_id' value='$rs[0]'>
                                <button style='font-size: 19px;' type='submit' class='btn btn-outline-success'>新增</button>
                            </div>
                    </form>";
                        }
                    ?>
                    <form method="POST" action="videos_msgdel.php" onsubmit="return check()">
                        <table class="table table-hover">
                            <?php
                            include("connection.php");
                            $sql = "SELECT * FROM video_msg WHERE video_id = '$id' order by video_msg_id desc";
                            $result = mysqli_query($conn, $sql);
                            $i = 1;
                            while ($i <= mysqli_num_rows($result)) {
                                $co = mysqli_fetch_row($result);
                            ?>
                        <tr>
                                <input type="hidden" name="video_id" value='<?php echo $rs[0]; ?>'>
                                <?php
                                $sql1 = "SELECT * FROM member where mem_phone = $co[2]";
                                $sqln = mysqli_query($conn, $sql1);
                                for ($z = 1; $z <= mysqli_num_rows($sqln); $z++) {
                                    $sq = mysqli_fetch_row($sqln);
                                if ($co[2] == $mem_phone){
                                    echo"<td style='line-height:50px;'><input class='hobby' type='checkbox' name='checkbox[]' value='$co[0]' /></td>";
                                }else{
                                    echo "<td><input type='hidden' name='' value=''/></td>";
                                }
                                ?>
                                <td style='line-height:50px;'>
                                    <img src="public/mempicture/<?php echo $sq[7].'?'.$time; ?>" alt="" width="50px" height="50px">
                                </td>
                                <td style='line-height:50px;'>
                                <?php 
                                if ($co[2]==$mem_phone){
                                    echo "<a href='userprofile.php'>$sq[2]</a>";
                                }else{
                                     echo "$sq[2]";
                                }
                                }
                                ?>
                                </td>
                                <td style='line-height:50px;'><?php echo $co[3] ?></td>
                                <td style='line-height:50px;'><?php echo $co[4] ?></td>
                                <td style='line-height:50px;'>
                                <?php if ($co[2] == $mem_phone) {
                                        echo "<a href='video_msg_update.php?id=$co[0]&msg=$co[3]&vid=$co[1]' style='font-size: 19px;' class='btn btn-outline-success' >修改留言</a> ";
                                    } else {
                                        echo '';
                                    } ?>
                                </td>
                <?php
                            $i++;
                        }
                    }
                }
            }       ?>
                            </tr>
        </table>
                        
                        <input type="button" name="Submit" value="返回" class='btn btn-outline-success' style='font-size: 19px;' onclick="location.href='video_view.php'" />
                        <input class='btn btn-outline-success' type="submit" name="del" value="刪除留言" style='font-size: 19px;'onclick="return confirm('確認刪除');" />
                    </form>
                    <br>
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