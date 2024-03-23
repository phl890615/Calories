<?php
$time = date('His', (time() + 7 * 3600));
$id = $_GET['id'];
include("connect.php");
$sql = "SELECT * FROM video WHERE video_id = '$id'";
$result = mysqli_query($link, $sql);
for ($i = 1; $i <= mysqli_num_rows($result); $i++) {
    $rs = mysqli_fetch_row($result);
    $sql = "SELECT * FROM diet_plan where diet_plan_id = $rs[2]";
    $res = mysqli_query($link, $sql);
    for ($X = 1; $X <= mysqli_num_rows($res); $X++) {
        $co = mysqli_fetch_row($res);

        $mem_name = "SELECT * FROM member where mem_phone = $rs[1]";
        $name = mysqli_query($link, $mem_name);
        for ($j = 1; $j <= mysqli_num_rows($name); $j++) {
            $na = mysqli_fetch_row($name);

            $vmsg = "SELECT * FROM video_msg where video_id = $rs[0]";
            $msg = mysqli_query($link, $vmsg);
            $num = mysqli_num_rows($msg);
            if ($rs[7] == 0) $get_fav = "素食";
            if ($rs[7] == 1) $get_fav = "蛋奶素";
            if ($rs[7] == 2) $get_fav = "葷食";
            if ($rs[8] == 1) $get_glut = "麩質";
            else $get_glut = "";
            if ($rs[9] == 1) $get_milk = "奶類";
            else $get_milk = "";
            if ($rs[10] == 1) $get_crust = "甲殼類";
            else $get_crust = "";
            if ($rs[11] == 1) $get_fish = "魚類";
            else $get_fish = "";
            if ($rs[12] == 1) $get_nut = "堅果類";
            else $get_nut = "";
            if ($rs[13] == 1) $get_bean = "豆類";
            else $get_bean = "";
            if ($rs[8]==0 and $rs[9]==0 and $rs[10]==0 and $rs[11]==0 and $rs[12]==0 and $rs[13]==0){
                $get_allign='無過敏類';
            }else{
                echo '';
            }
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
		<h1><a href="index.php">WELCOME<span>熱力適攝</span></a></h1>
		<ul id="navigation" style='line-height: 3;width: 1000px;font-size: 20px;'>
			<li class="current;">
				<a href="index.php">首頁</a>
			</li>
			<li>
				<a href="user.php">會員管理</a>
			</li>
			<li>
				<a href="video_view.php">影片管理</a>
				<ul>
					<li>
						<a href="videotext_add.php" style='font-size:19px;'>管理者新增影片</a>
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
                    <table class="table table-striped" style="width: 700px; margin: 0 auto;padding: 0px;font-family:微軟正黑體;background-color:white">
                        <tr>
                            <td style="width: 160px;">
                                <p style="font-size: 20px;">影片ID:</p>
                            </td>
                            <td>
                                <p style="font-size: 15px;"><?php echo $rs[0] ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p style="font-size: 20px;">發佈者:</p>
                            </td>
                            <td>
                                <p style="font-size: 15px;"><?php echo $na[2] ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p style="font-size: 20px;">影片標題:</p>
                            </td>
                            <td>
                                <p style="font-size: 15px;"><?php echo $rs[3] ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p style="font-size: 20px;">飲食法:</p>
                            </td>
                            <td>
                                <p style="font-size: 15px;"><?php echo $co[1] ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p style="font-size: 20px;">影片簡介:</p>
                            </td>
                            <td>
                                <p style="font-size: 15px;"><?php echo $rs[4] ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p style="font-size: 20px;">影片食材:</p>
                            </td>
                            <td>
                                <p style="font-size: 15px;"><?php echo $rs[5] ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p style="font-size: 20px;">影片餐期:</p>
                            </td>
                            <td>
                                <p style="font-size: 15px;"><?php echo $rs[6] ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p style="font-size: 20px;">飲食偏好:</p>
                            </td>
                            <td>
                                <p style="font-size: 15px;"><?php echo $get_fav ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p style="font-size: 20px;">過敏類:</p>
                            </td>
                            <td>
                                <p style="font-size: 15px;"><?php echo @$get_allign ?><?php echo $get_glut ?><?php echo $get_milk ?><?php echo $get_crust ?><?php echo $get_fish ?><?php echo $get_nut ?><?php echo $get_bean ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p style="font-size: 20px;">製作難度:</p>
                            </td>
                            <td>
                                <p style="font-size: 15px;"><?php echo $get_level ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p style="font-size: 20px;">上傳時間:</p>
                            </td>
                            <td>
                                <p style="font-size: 15px;"><?php echo $rs[15] ?></p>
                            </td>
                        </tr>
                    </table>
                    <table class="table table-borderless" style="width: 500px;margin:0 auto">
                        <tr>
                            <td><video width='700'  controls><source src='../video/<?php echo $rs[0].'.mp4'.'?'.$time; ?>' type='video/mp4'></video></td>
                        </tr>
                    </table>
                    <form method='post' action='video_msginsert.php'>
                        <div class="input-group mb-3">
                            <input type="text" name="msg" style="border-color:#6DC757;border-width:3px;" placeholder="請輸入留言..." class="form-control" aria-label="Username" aria-describedby="basic-addon1" required>
                            <input type="hidden" name="phone" value='0900000000'>
                            <input type="hidden" name="video_id" value='<?php echo $rs[0]; ?>'>
                            <button type="submit" class="btn btn-success">新增</button>
                        </div>
                    </form>

                    <form method="POST" action="videos_msgdel.php" onsubmit="return check()">
                        <table class="table table-hover" style='background-color:white;'>
                            <?php
                            include("connect.php");
                            $sql = "SELECT * FROM video_msg WHERE video_id = '$id' order by video_msg_id desc";
                            $result = mysqli_query($link, $sql);
                            $i = 1;
                            while ($i <= mysqli_num_rows($result)) {
                                $co = mysqli_fetch_row($result);
                            ?>
                                <tr>
                                    <td><input type="hidden" name="video_id" value='<?php echo $rs[0]; ?>'></td>
                                    <td style='line-height:50px;'><input class="hobby" type="checkbox" name="checkbox[]" value="<?php echo $co[0] ?>" /></td>
                                    <?php
                                    $sql1 = "SELECT * FROM member where mem_phone = $co[2]";
                                    $sqln = mysqli_query($link, $sql1);
                                    for ($z = 1; $z <= mysqli_num_rows($sqln); $z++) {
                                    $sq = mysqli_fetch_row($sqln);
                                    ?>
                                    <td style='line-height:50px;'>
                                        <img src="../calories1/public/mempicture/<?php echo $sq[7];?>" alt="" width="50px" height="50px">
                                    </td>
                                    <td style='line-height:50px;'><?php echo "<a href='userselect.php?phone=$co[2]'>$sq[2]</a>" ?></td>
                                    <?php 
                                    }
                                    ?>
                                    <td style='line-height:50px;'><?php echo $co[3] ?></td>
                                    <td style='line-height:50px;'><?php echo $co[4] ?></td>
                                    <td style='line-height:50px;'><?php if ($co[2] == '0900000000') {
                                            echo "<a href='video_msg_update.php?id=$co[0]&msg=$co[3]&vid=$co[1]' >修改留言</a> ";
                                        } else {
                                            echo '';
                                        } ?></td>
                                <?php
                                $i++;
                            }
                                ?>
                                </tr>
                        </table>
                        <input type="button" name="Submit" value="返回" class="btn btn-success" onclick="location.href='video_view.php'" />
                        <input class="btn btn-success" type="submit" name="del" value="刪除留言" onclick="return confirm('確認刪除');" />
                    </form>
        <?php
        }
    }
}       ?>
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