<?php
//$id =  $_POST['video_id'];
if (isset($_POST["del"])) {
    include('connect.php'); //連結資料庫
    $check = $_POST['checkbox'];
    foreach ($check as $msg) {
        $sql = "DELETE FROM video_msg where video_msg_id = '$msg'";
        $result = mysqli_query($link, $sql); //執行sql
    }
    if ($result) {
        header("refresh:0;url=video_onemsg.php?id=$id");
        exit;
    } else {
        echo "刪除錯誤";
    }
}

if (isset($_POST["update"])) {
    include('connect.php'); //連結資料庫
    $v_msg_id = $_POST['msg_id'];
    $video_msg_cont = $_POST['msg_cont'];
    $video_id = $_POST['v_id'];
    $sql = "UPDATE video_msg SET video_msg_cont='$video_msg_cont' where video_msg_id = '$v_msg_id'";
     $result = mysqli_query($link, $sql); //執行sql
     if ($result) {
         header("refresh:0;url=video_onemsg.php?id=$video_id");
         exit;
     } else {
         echo "刪除錯誤";
     }
}
