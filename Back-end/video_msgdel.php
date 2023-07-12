<?php
if (isset($_POST["del"])) {
    include('connect.php'); //連結資料庫
    $check = $_POST['checkbox'];
    foreach ($check as $msg) {
        $sql = "DELETE FROM video_msg where video_msg_id = '$msg'";
        $result = mysqli_query($link, $sql); //執行sql
    }
    if ($result) {
        header("refresh:0;url=video_msg.php");
    } else {
        echo "刪除錯誤";
    }
}
