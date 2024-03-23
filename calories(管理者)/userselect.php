<?php
session_start();
if ($_SESSION['Name']=='manager'){
	
}else{
	header("refresh:0;url=manager.php");
}
include("connect.php");
$phone = $_GET['phone'];
$sql = "SELECT * FROM member where mem_phone = $phone ";
$result = mysqli_query($link, $sql) or die('MySQL connect error');

//判斷表單是否按送出而執行修改
if ((isset($_POST['modify'])) && ($_POST['modify'] == 'yes')) {
  $email = $_POST['email'];
  $pwd = $_POST['pwd'];
  $name = $_POST['name'];
  $bir = $_POST['bir'];
  $state = $_POST['state'];
  $gender = $_POST['gender'];
  $sql = "UPDATE member SET mem_state='$state' where mem_phone = $phone ";
  $result = mysqli_query($link, $sql) or die('MySQL insert error');
  mysqli_close($link);
  header("Location: user.php"); //修改後前往某網頁
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
      <h2>會員檢視</h2>
    </div>
    <?php 
    while ($row = mysqli_fetch_assoc($result)) { 
      ?>
      <form method="post" name="form" style="text-align: center">
        <div class="input-group mb-3">
          <span class="input-group-text" id="basic-addon1">會員信箱:</span>
          <input type="text" name="email" readonly="readyonly" value="<?php echo $row['mem_email']; ?>" class="form-control" aria-describedby="basic-addon1">
        </div>

        <div class="input-group mb-3">
          <span class="input-group-text" id="basic-addon1">會員電話:</span>
          <input type="text" name="phone" readonly="readyonly" value="<?php echo $row['mem_phone']; ?>" class="form-control" aria-describedby="basic-addon1">
        </div>

        <div class="input-group mb-3">
          <span class="input-group-text" id="basic-addon1">會員暱稱:</span>
          <input type="text" name="name" readonly="readyonly" value="<?php echo $row['mem_name']; ?>" class="form-control" aria-describedby="basic-addon1">
        </div>

        <?php
        if($row['mem_gender']==0){
          $get_gender = '男生';
        }else{
          $get_gender = '女生';
        }
        ?>
        <div class="input-group mb-3">
          <span class="input-group-text" id="basic-addon1">會員性別:</span>
          <input type="text" name="name" readonly="readyonly" value="<?php echo $get_gender; ?>" class="form-control" aria-describedby="basic-addon1">
        </div>

        <div class="input-group mb-3">
          <span class="input-group-text" id="basic-addon1">會員生日:</span>
          <input type="text" name="bir" readonly="readyonly" value="<?php echo $row['mem_bir']; ?>" class="form-control" aria-describedby="basic-addon1">
        </div>

        <div class="input-group" style="width: auto;">
          <span class="input-group-text">會員狀態:</span>
          <select name="state" class="form-select" id="inputGroupSelect01">
            <option selected hidden value="<?php echo $row['mem_state'] ?>"> <?php if ($row['mem_state'] == 0) {
                                                                        echo '正常';
                                                                      } else {
                                                                        echo '封鎖';
                                                                      }; ?> </option>
            <option value="0">正常</option>
            <option value="1">封鎖</option>
          </select>
        </div>
        <br />
        <input class="btn btn-success" type="submit" value="確定" style="margin-right:15px;">
        <input class="btn btn-success" type="button" value="取消" onclick="location.href='user.php'">

        <input name="modify" type="hidden" value="yes">
        <?
        //隱藏欄位用來判斷是否送出,來做修改的動作
        ?>
      </form>
    <?php } ?>
    </main>
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