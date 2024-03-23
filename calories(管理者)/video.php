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
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="text-center">
                    <h2>留言管理</h2><br />
                </div> 
                <div class="cal26rd">
                    <h5 class="card-title mt-3 ml-4 text-muted"></h5>
                    <div class="card-body">
                    <form id="form1" name="form1" method="post" action="">
                    <table >
                        <?php
                            include("connect.php");
                            $sql = "select * from video";
                            $result = mysqli_query($link, $sql);
                            $i=1;
                            while($i <=mysqli_num_rows($result)){
                                $co = mysqli_fetch_row($result);
                        ?>
                            <tr>
                                <td>影片編號:<?php echo $co[0]?></td>
                                <td><?php echo "<a href='videos_msg.php?video_id=$co[0]'>留言</a>"?></td>
                        <?php
                            $i++;
                            }
                        ?>
                            </tr>
                    </table>
                    </form>  
                    <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html> 