<?php
session_start();
if ($_SESSION['Name']=='manager'){
	
}else{
	header("refresh:0;url=manager.php");
}
$time = date('His', (time() + 7 * 3600));
error_reporting(0);
include("connect.php");
$id = $_GET['id'];
$sql = "SELECT * FROM video where video_id = $id ";
$result = mysqli_query($link, $sql) or die('MySQL connect error');
for ($i = 1; $i <= mysqli_num_rows($result); $i++) {
    $re = mysqli_fetch_row($result);

    $memname = "SELECT * FROM member where mem_phone = $re[1] ";
    $name = mysqli_query($link, $memname) or die('MySQL connect error');
    for ($i = 1; $i <= mysqli_num_rows($name); $i++) {
        $na = mysqli_fetch_row($name);

        $planid = "SELECT * FROM diet_plan where diet_plan_id = $re[2] ";
        $data = mysqli_query($link, $planid) or die('MySQL connect error');
        for ($i = 1; $i <= mysqli_num_rows($data); $i++) {
            $row = mysqli_fetch_row($data);

            $per = explode(',', $re[6]);
            if ($re[14] == 1) {
                $get_level = "毫無難度";
            } elseif ($re[14] == 2) {
                $get_level = "新手";
            } elseif ($re[14] == 3) {
                $get_level = "正常";
            } elseif ($re[14] == 4) {
                $get_level = "稍難";
            } else {
                $get_level = "困難";
            }
?>

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
                    <div style="text-align: center">
                        <h2>影片修改</h2>
                    </div>
                    <form action="update_video_revise.php" method="post" name="form" style="width:700px">
                        <div class="input-group mb-3">
                            <span style="width:15%" class="input-group-text" id="basic-addon1">影片編號:</span>
                            <input type="text" name="id" readonly="readonly" value="<?php echo $re[0]; ?>" class="form-control" aria-describedby="basic-addon1">
                        </div>

                        <div class="input-group mb-3">
                            <span style="width:15%" class="input-group-text" id="basic-addon1">發布者 :</span>
                            <input type="text" name="phone" readonly="readonly" value="<?php echo $na[2]; ?>" class="form-control" aria-describedby="basic-addon1">
                        </div>

                        <div class="input-group mb-3">
                            <span style="width:15%" class="input-group-text" id="basic-addon1">影片標題:</span>
                            <input type="text" name="title" value="<?php echo $re[3]; ?>" class="form-control" aria-describedby="basic-addon1">
                        </div>

                        <div class="input-group mb-3">
                            <span style="width:15%" class="input-group-text" id="basic-addon1">飲食法:</span>
                            <select name="diet_plan" class="form-select" id="inputGroupSelect01" required>
                                <option selected hidden value="<?php echo $re[2]; ?>"><?php echo $row[1]; ?> </option>
                                <?php
                                include('connect.php');
                                $sql = "SELECT * FROM diet_plan";
                                $result = mysqli_query($link, $sql);
                                $i = 1;
                                while ($i <= mysqli_num_rows($result)) {
                                    $co = mysqli_fetch_row($result);
                                    echo '<option value="', $co[0], '">', $co[1], '</option>';
                                    $i++;
                                }
                                ?>
                            </select>
                        </div>

                        <div class="input-group mb-3">
                            <span style="width:15%" class="input-group-text" id="basic-addon1">影片簡介:</span>
                            <textarea name="cont" class="form-control" id="exampleFormControlTextarea1" rows="3"><?php echo $re[4]; ?></textarea>
                        </div>

                        <div class="input-group mb-3">
                            <span style="width:15%" class="input-group-text" id="basic-addon1">影片食材:</span>
                            <textarea name="method" class="form-control" id="exampleFormControlTextarea1" rows="5"><?php echo $re[5]; ?></textarea>
                        </div>

                        <span class="input-group-text" id="basic-addon1">影片餐期:</span>

                        <table class="table table-borderless" style="width: 600px;margin:0 auto">
                            <tr>
                                <td>
                                    <input class="form-check-input" type="checkbox" name="select_item[]" value="早餐" id="flexCheckChecked" <?php echo $per[0] == '早餐' ? 'checked' : ''; ?>>
                                    <div>早餐</div>
                                </td>
                                <td>
                                    <input class="form-check-input" type="checkbox" name="select_item[]" value="午餐" id="flexCheckChecked" <?php echo ($per[0] == '午餐') || ($per[1] == '午餐') ? 'checked' : ''; ?>>
                                    <div>午餐</div>
                                </td>
                                <td>
                                    <input class="form-check-input" type="checkbox" name="select_item[]" value="晚餐" id="flexCheckChecked" <?php echo ($per[0] == '晚餐') || ($per[1] == '晚餐') || ($per[2] == '晚餐') ? 'checked' : ''; ?>>
                                    <div>晚餐</div>
                                </td>
                                <td>
                                    <input class="form-check-input" type="checkbox" name="select_item[]" value="點心" id="flexCheckChecked" <?php echo ($per[0] == '點心') || ($per[1] == '點心') || ($per[2] == '點心') || ($per[3] == '點心') ? 'checked' : ''; ?>>
                                    <div>點心</div>
                                </td>
                            </tr>
                        </table>
                        <div class="input-group mb-3">
                            <span style="width:15%" class="input-group-text" id="basic-addon1">飲食偏好:</span>
                            <select name="fav" class="form-select" id="inputGroupSelect01">
                                <option selected hidden value="<?php echo $re[7]; ?>"><?php if ($re[7] == 0) {
                                                                                    echo "全素";
                                                                                } elseif ($re[7] == 1) {
                                                                                    echo "蛋奶素";
                                                                                } else {
                                                                                    echo "葷食";
                                                                                }
                                                                                ?> </option>
                                <?php
                                if ($re[7] == 0) {
                                    echo '<option value="1">蛋奶素</option>';
                                    echo '<option value="2">葷食</option>';
                                } elseif ($re[7] == 1) {
                                    echo '<option value="0">全素</option>';
                                    echo '<option value="2">葷食</option>';
                                } else {
                                    echo '<option value="0">全素</option>';
                                    echo '<option value="1">蛋奶素</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <table class="table table-striped" style='background-color:white'>
                            <tr>
                                <td>
                                    過敏類:
                                </td>
                            </tr>
                            <tr>
                                <td>1.麩質類過敏:</td>
                                <td><input type="radio" name="glut" value="1" <?php echo $re[8] == 1 ? 'checked' : ''; ?>>是</td>
                                <td><input type="radio" name="glut" value="0" <?php echo $re[8] == 0 ? 'checked' : ''; ?>>否</td>
                            </tr>
                            <tr>
                                <td>2.奶類過敏:</td>
                                <td><input type="radio" name="milk" value="1" <?php echo $re[9] == 1 ? 'checked' : ''; ?> />是</td>
                                <td><input type="radio" name="milk" value="0" <?php echo $re[9] == 0 ? 'checked' : ''; ?> />否</td>
                            </tr>
                            <tr>
                                <td>3.甲殼類過敏:</td>
                                <td><input type="radio" name="crust" value="1" <?php echo $re[10] == 1 ? 'checked' : ''; ?> />是</td>
                                <td><input type="radio" name="crust" value="0" <?php echo $re[10] == 0 ? 'checked' : ''; ?> />否</td>
                            </tr>
                            <tr>
                                <td>4.魚類過敏:</td>
                                <td><input type="radio" name="fish" value="1" <?php echo $re[11] == 1 ? 'checked' : ''; ?> />是</td>
                                <td><input type="radio" name="fish" value="0" <?php echo $re[11] == 0 ? 'checked' : ''; ?> />否</td>
                            </tr>
                            <tr>
                                <td>5.堅果類過敏:</td>
                                <td><input type="radio" name="nut" value="1" <?php echo $re[12] == 1 ? 'checked' : ''; ?> />是</td>
                                <td><input type="radio" name="nut" value="0" <?php echo $re[12] == 0 ? 'checked' : ''; ?> />否</td>
                            <tr>
                                <td>豆類過敏:</td>
                                <td><input type="radio" name="bean" value="1" <?php echo $re[13] == 1 ? 'checked' : ''; ?> />是</td>
                                <td><input type="radio" name="bean" value="0" <?php echo $re[13] == 0 ? 'checked' : ''; ?> />否</td>
                            </tr>
                        </table>

                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">製作難度:</span>
                            <select name="level" class="form-select" id="inputGroupSelect01">
                                <option selected value="<?php echo $re[14]; ?>"> <?php echo $get_level; ?> </option>
                                <option value="1"> 毫無難度 </option>
                                <option value="2"> 新手 </option>
                                <option value="3"> 正常 </option>
                                <option value="4"> 稍難 </option>
                                <option value="5"> 困難 </option>
                            </select>
                        </div>
                        <table class="table table-borderless" style="width: 200px;margin:left">
                            <tr>
                                <td><input type=submit class="btn btn-success" value='確認修改'></td>
                                <td><input type="button" class="btn btn-success" value="取消修改" onclick="location.href='video_view.php'"></td>
                            </tr>
                        </table>
                    </form>
                    <table class="table table-borderless" style="width: 500px;margin:0 auto">
                        <tr>
                            <td><button class='btn btn-success' name='v_id' onclick="location.href='video_update.php?v_id=<?php echo $re[0]; ?>'">修改影片</button></td>
                        </tr>
                        <tr>
                        <td><video width='700' height='360' controls><source src='../video/<?php echo $re[0].'.mp4'.'?'.$time; ?>' type='video/mp4'></video></td>
                        </tr>
                    </table>
        <?php
        }
    }
}
        ?>
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