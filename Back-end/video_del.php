<?php
include("connect.php");

$id = $_GET['id'];

$sql = "DELETE FROM video WHERE video_id = $id";  //刪除資料

mysqli_query($link, $sql) or die('MySQL connect error'); //執行sql語法

mysqli_close($link); //關閉資料庫連結

header("location:videotext_add.php");  //回index.php
