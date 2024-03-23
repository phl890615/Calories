
<?php
include("connection.php");
date_default_timezone_set("Asia/Taipei");
$phone = $_POST['phone'];
$msg = $_POST['msg'];
$id = $_POST['video_id'];
$date = date("Y-m-d H:i:s");
$sql = "INSERT INTO video_msg (video_id, mem_phone, video_msg_cont, video_msg_time)
VALUES ('$id', '$phone', '$msg', '$date');";
if (!mysqli_query($conn, $sql)) {
  die('錯誤');
}
header("Location: video_onemsg.php?id=$id");
