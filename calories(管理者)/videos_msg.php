<script type="text/javascript">
    function checkAll(){
	    var hobby  =document.getElementsByClassName("hobby");
	    for(var i  =0;i<hobby.length;i++){
	        var h = hobby[i];
	        h.checked = true;				
        }
				
    }
			
    function  unCheckAll(){
	    var hobby  =document.getElementsByClassName("hobby");
	    for(var i  =0;i<hobby.length;i++){
	        var h = hobby[i];
	        h.checked = false;
					
        }
    }
    function check() {
        var checkbox = document.getElementsByName("checkbox[]");
        var msg = [];
        for(i in checkbox){
            if(checkbox[i].checked == true){
                msg.push(checkbox[i].value);
            }
        }
        if (msg.length != 0) {
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
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="text-center">
                    <h2>留言管理</h2><br />
                </div> 
                <div class="cal26rd">
                    <h5 class="card-title mt-3 ml-4 text-muted"></h5>
                    <div class="card-body">
                    <p></p>
                        <td><input class="btn btn-outline-primary" type="button" value="全選" onclick="checkAll()" />
                            <input class="btn btn-outline-primary"  type="button" value="取消" onclick="unCheckAll()" /></td>
                    <form method="POST" action="videos_msgdel.php" onsubmit="return check()">
                    <table >
                        <?php
                            session_start();
                            include("connect.php");
                            if(isset($_GET['video_id'])!='' ){
                                $id = $_GET['video_id'];
                                $_SESSION["video_id"] = $id;
                            }else{
                                $id = $_SESSION["video_id"];
                            }
                            $sql = "SELECT * FROM video_msg WHERE video_id = '$id'";
                            $result = mysqli_query($link, $sql);
                            $i=1;
                            while($i <=mysqli_num_rows($result)){
                                $co = mysqli_fetch_row($result);
                        ?>
                            <tr>
                                <td><input class="hobby" type="checkbox" name="checkbox[]" value= "<?php echo $co[3]?>" /></td>
                                <td><?php echo "<a href='userselect.php?phone=$co[2]'>$co[2]</a>"?></td>
                                <td><?php echo $co[3]?></td>
                                <td><?php echo $co[4]?></td>
                        <?php
                            $i++;
                            }
                        ?>

                            </tr>

                    </table>
                        <br />
                            <div >
                                <input type="button" name="Submit" value="返回" class="btn btn-outline-primary" onclick="location.href='video.php'"/>
                                <input class="btn btn-outline-primary" type="submit" name="del" value="刪除" onclick = "return confirm('確認刪除');"/>
                            </div>
                    </form>
                    <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html> 