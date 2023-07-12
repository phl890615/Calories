<?php
$db_sever = 'localhost';
$db_user ='10714144';
$db_pwd = '10714144';
$db_name = 'calories';
$table = 'video';

$link = mysqli_connect($db_sever,$db_user,$db_pwd,$db_name);
if($link){
    mysqli_query($link,'SET NAMES uff8');
    //echo "正確連接資料庫";
}
else {
    echo "不正確連接資料庫</br>" . mysqli_connect_error();
}


$db_select = mysqli_select_db($link,$db_name);
if (!$db_select){
    die ('Can\'t use db: ' .mysqli_error());
}

?>
