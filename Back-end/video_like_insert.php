<?php
include("connect.php");
$id = $_POST["id"];
$v_id = $_POST["v_id"];

echo $id;
echo $v_id;

$data = "UPDATE video_like SET video_like_state='1' where mem_phone = '$id' and video_id = '$v_id' ";

$like = mysqli_query($link, $data) or die('MySQL connect error');
