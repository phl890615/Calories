<?php
include("connect.php");
$id = $_POST["id"];
$v_id = $_POST["v_id"];

$data = "DELETE FROM `video_like` WHERE `video_id`= '$v_id' and `mem_phone`= '$id'";

$like = mysqli_query($link, $data) or die('MySQL connect error');

echo $id;
echo $v_id;
