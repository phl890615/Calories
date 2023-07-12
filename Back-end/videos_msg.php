<script>
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
</script>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>熱力適攝</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
<div id="header">
		<h1><a href="index.php">WELCOME<span>熱力適攝</span></a></h1>
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
<div id="body">
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
                    <form method="POST" action="videos_msgdel.php">
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