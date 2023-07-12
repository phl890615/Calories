<?php
include("connect.php");

$id = $_GET['id'];

echo $id;

$sql3 = "DELETE FROM video_like WHERE video_id = $id";  //刪除資料

mysqli_query($link, $sql3) or die('MySQL connect error'); //執行sql語法

$sql2 ="DELETE FROM video_msg WHERE video_id = $id";  //刪除資料

mysqli_query($link,$sql2)or die ('MySQL2 connect error'); //執行sql語法

$sql ="DELETE FROM video WHERE video_id = $id";  //刪除資料

mysqli_query($link,$sql)or die ('MySQL connect error'); //執行sql語法

mysqli_close($link); //關閉資料庫連結

unlink("../video/$id.mp4");

header( "location:video_view.php");  //回index.php
