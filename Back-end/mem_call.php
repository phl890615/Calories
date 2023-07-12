<?php
//$mem_phone = $_SESSION['mem_phone'];
$sql = "SELECT * FROM member WHERE mem_phone = '$mem_phone'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
$mem_mail = $row['mem_,mail'];
$mem_start = $row['mem_start'];
$mem_end = $row['mem_end'];
if ($row['mem_call']== 1){
    if(){
        
    }elseif(){
        
    }
}
?>