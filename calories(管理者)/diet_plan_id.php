<!DOCTYPE html>
<heml>
<form id="form1" name="form1" method="post" action="">
  <p>
    <input name="search" type="text" />  <input type="submit" name="button" value="搜尋" />
  </p>
</form>
<?php 
//error_reporting(0);
include("connect.php");
//$sql="SELECT * FROM video order by video_id desc";
if(isset($_POST['search'])!='' ){
 $search=$_POST['search'];
 $sql = "select * from video where video_title LIKE '%".$search."%' order by video_id desc";
}else{
 $sql = "select * from video order by video_id desc";
}
$result=mysqli_query($link,$sql);
for($i=0;$i<=mysqli_num_rows($result);$i++){ 
    $rs=mysqli_fetch_row($result);

$diet_id = "SELECT * FROM diet_plan where diet_plan_id = $rs[2]";
$dietid = mysqli_query($link, $diet_id);
$i=1;
while($i <=mysqli_num_rows($dietid)){
    $co = mysqli_fetch_row($dietid);
    $i++;

$mem_id = "SELECT * FROM member where mem_phone = $rs[1]";
$mem_name = mysqli_query($link, $mem_id);
$i=1;
while($i <=mysqli_num_rows($mem_name)){
    $name = mysqli_fetch_row($mem_name);
    $i++;

?>
<br />
<td>影片ID:<?php echo $rs[0]?></td>
<td>會員名稱:<?php echo $name[2]?></td>
<br />
<td><?php echo $co[1]?></td>
<br/>
<td>影片標題:<?php echo $rs[3]?></td>
<br/>
<td><?php echo $rs[4]?></td>
<br/>
<td>餐點作法:<?php echo $rs[5]?></td>
<br/>
<td>上傳時間:<?php echo $rs[15]?></td>
<br/>
<td><?php echo "<video width='360' height='270' controls><source src='../video/$rs[0].mp4' type='video/mp4'></video>";?></td>
<br/>
<?php
}
}
}   
?>
</heml>