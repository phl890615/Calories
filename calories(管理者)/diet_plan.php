<?php
session_start();
if ($_SESSION['Name']=='manager'){
	
}else{
	header("refresh:0;url=manager.php");
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
    <table>
        <tr>
            <td width='350px'>
                <a href="diet_plan.php" title="back"><img src="../picture/back.png" border="0" width="40"></a>
            </td>
            <td>
                <h2 style="text-align: center">飲食法管理</h2>
            </td>
        </tr>
    </table>
        <?php if (!empty($_POST) or !empty($_GET)) : ?>
            <?php
            include('connect.php');
            if(isset($_GET["sort"])!=""){
                $sort = $_GET["sort"];
            }else{
                $sort = htmlspecialchars($_POST["aaa"]);
            }
            $sql = "SELECT * FROM diet_plan WHERE diet_plan_id = '$sort'";
            $result = mysqli_query($link, $sql);
            $row = mysqli_fetch_row($result);
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <div class="input-group mb-3">
                    <span style="width:15%" class="input-group-text" id="basic-addon1">飲食法:</span>
                    <select name="aaa" class="form-select" id="inputGroupSelect01" onchange="submit();">
                        <option value="" disabled selected hidden><?php echo $row['1'] ?></option>
                        <?php
                        include('connect.php');
                        $sql = "SELECT * FROM diet_plan";
                        $result = mysqli_query($link, $sql);
                        $i = 1;
                        while ($i <= mysqli_num_rows($result)) {
                            $co = mysqli_fetch_row($result);
                                echo '<option value="' ,$co[0] ,'">', $co[1], '</option>';
                            $i++;
                        }
                        ?>
                    </select>
                </div>
            </form>
            <form method="POST" action="diet_planadd.php">
                <div class="input-group mb-3">
                    <span style="width:15%" class="input-group-text" id="basic-addon1">飲食法編號:</span>
                    <input class="form-control" style="resize:none" name="id" rows="4" required="required" readonly="readonly" value="<?php echo $row['0'] ?>">
                </div>

                <div class="input-group mb-3">
                    <span style="width:15%" class="input-group-text" id="basic-addon1">飲食法名稱:</span>
                    <input class="form-control" style="resize:none" name="sort" rows="4" required="required" readonly="readonly" value="<?php echo $row['1'] ?>">
                </div>

                <div class="input-group mb-3">
                    <span style="width:15%" class="input-group-text" id="basic-addon1">簡介:</span>
                    <textarea class="form-control" style="resize:none" name="sum" rows="6" required="required"><?php echo $row['2'] ?></textarea>
                </div>

                <div class="input-group mb-3">
                    <span style="width:15%" class="input-group-text" id="basic-addon1">優點:</span>
                    <textarea class="form-control" style="resize:none" name="adv" rows="6" required="required"><?php echo $row['3'] ?></textarea>
                </div>

                <div class="input-group mb-3">
                    <span style="width:15%" class="input-group-text" id="basic-addon1">缺點:</span>
                    <textarea class="form-control" style="resize:none" name="dis" rows="6" required="required"><?php echo $row['4'] ?></textarea>
                </div>

                <div class="input-group mb-3">
                    <span style="width:15%" class="input-group-text" id="basic-addon1">食物類型:</span>
                    <textarea class="form-control" style="resize:none" name="food" rows="6" required="required"><?php echo $row['5'] ?></textarea>
                </div>

                <div class="input-group mb-3">
                    <span style="width:15%" class="input-group-text" id="basic-addon1">注意事項:</span>
                    <textarea class="form-control" style="resize:none" name="sup" rows="6" required="required"><?php echo $row['6'] ?></textarea>
                </div>

                <a href="diet_food.php?id=<?php echo $row['0']; ?>" onclick="diet_food.php;" class="btn btn-success">推薦食物</a>
                <br />
                <br />
                <div style="text-align:right"><input class="btn btn-success" type="submit" name="update" value="修改飲食法" />
                    <input class="btn btn-success" type="submit" name="del" value="刪除飲食法" onclick="return confirm('確認刪除');" />
                </div>
</body>
</form>
<?php else : ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <div class="input-group mb-3">
            <span style="width:15%" class="input-group-text" id="basic-addon1">飲食法:</span>
            <select name="aaa" class="form-select" id="inputGroupSelect01" required onchange="submit();">
                <option value="" disabled selected hidden>新增飲食法</option>
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
    </form>

    <form method="POST" action="diet_planadd.php">
        <div class="input-group mb-3">
            <span style="width:15%" class="input-group-text" id="basic-addon1">名稱:</span>
            <textarea class="form-control" style="resize:none" name="sort" placeholder="請輸入..." rows="4" required="required"></textarea>
        </div>

        <div class="input-group mb-3">
            <span style="width:15%" class="input-group-text" id="basic-addon1">簡介:</span>
            <textarea class="form-control" style="resize:none" name="sum" placeholder="請輸入..." rows="4" required="required"></textarea>
        </div>

        <div class="input-group mb-3">
            <span style="width:15%" class="input-group-text" id="basic-addon1">優點:</span>
            <textarea class="form-control" style="resize:none" name="adv" placeholder="請輸入..." rows="4" required="required"></textarea>
        </div>

        <div class="input-group mb-3">
            <span style="width:15%" class="input-group-text" id="basic-addon1">缺點:</span>
            <textarea class="form-control" style="resize:none" name="dis" placeholder="請輸入..." rows="4" required="required"></textarea>
        </div>

        <div class="input-group mb-3">
            <span style="width:15%" class="input-group-text" id="basic-addon1">食物類型:</span>
            <textarea class="form-control" style="resize:none" name="food" placeholder="請輸入..." rows="4" required="required"></textarea>
        </div>

        <div class="input-group mb-3">
            <span style="width:15%" class="input-group-text" id="basic-addon1">注意事項:</span>
            <textarea class="form-control" style="resize:none" name="sup" placeholder="請輸入..." rows="4" required="required"></textarea>
        </div>

        <div style="text-align:right"><input class="btn btn-success" type="submit" name="com" value="新增" /></div>
    </form>
<?php endif; ?>
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