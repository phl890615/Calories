<?<?php
if(isset($_POST['search'])!='' ){
 $search=$_POST['search'];
 $data = "select * from members1 where mem_phone LIKE '%".$search."%'";
}else{
 $data = "select * from members1";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>會員總覽</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <p>
    <input name="search" type="text" />  <input type="submit" name="button" value="搜尋" />
  </p>
</form>
<p></p>
<table width="700" border="1">
   <tr>
    <td >電子信箱</td>
    <td >會員電話</td>
    <td >狀態</td>
    <td >檢視</td>
<?php
 include("connect.php");
 $rs = mysqli_query($link, $data);
   for($i=1;$i<=mysqli_num_rows($rs);$i++){
 $co = mysqli_fetch_row($rs);
 $get_co;
if($co[9]==0) $get_co = "正常";
     else $get_co = "封鎖";

?>
  <tr>
    <td><?php echo $co[6]?></td>
    <td><?php echo $co[5]?></td>
    <td><?php echo $get_co?></td>
    <td><?php echo "<a href='userselect.php?phone=$co[5]'>修改</a>";
}
?>

  </tr>

</table>

    </body>

</html>