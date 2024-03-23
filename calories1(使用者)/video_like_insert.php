<?php
include("connection.php");
$id = $_POST["id"];
$v_id = $_POST["v_id"];

echo $id;
echo $v_id;

$data = "INSERT INTO  `video_like` (`video_id`,`mem_phone`) VALUE ('$v_id','$id')";

$like = mysqli_query($conn, $data) or die('MySQL connect error');
