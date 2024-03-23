
<?php

include("connection.php");

$id = $_POST['id'];
$title = $_POST['title'];
$plan_id = $_POST['diet_plan'];
$cont = $_POST['cont'];
$method = $_POST['method'];
$tag = $_POST['select_item'];
$per = implode(',', $tag);
$fav = $_POST['fav'];
$glut = $_POST['glut'];
$milk = $_POST['milk'];
$crust = $_POST['crust'];
$fish = $_POST['fish'];
$nut = $_POST['nut'];
$bean = $_POST['bean'];
$level = $_POST['level'];

$sql = "UPDATE video SET 
video_title = '$title', 
diet_plan_id = '$plan_id',
video_cont = '$cont',
video_method = '$method',
video_period = '$per',
video_fav = '$fav',
video_allergy_glut = '$glut',
video_allergy_milk = '$milk',
video_allergy_crust = '$crust',
video_allergy_fish = '$fish',
video_allergy_nut = '$nut',
video_allergy_bean = '$bean',
video_level = '$level'
where video_id = $id ";

$result = mysqli_query($conn, $sql) or die('MySQL insert error');

mysqli_close($conn);

header("Location: video_like.php");
?>