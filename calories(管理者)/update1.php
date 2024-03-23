<?php
include('connect.php');
$sql = "SELECT * FROM members1";
$result = mysqli_query($link, $sql) or die('MySQL connect error');
if((isset($_POST['modify'])) && ($_POST['modify']=='修改')){
    $id=$_POST['mem_id'];
    $name=$_POST['mem_name'];
    $phone=$_POST['mem_phone'];
    $sql="UPDATE members1 SET mem_name='$name'";
    //WHERE mem_id='.$_POST[id]'
    $result=mysqli_query($link, $sql) or die('MySQL insert error');
    mysqli_close($link);
    header("Location: index.html"); //修改後前往某網頁
} 
	
	
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<center>
<title>無標題文件</title>
</head>

<body>
<form id="content" action="update2.php" method="post" target="yframe" enctype="multipart/form-data">
  <table width="389" border="1" align="left">
      <td width="101" align="right" style="text-align: center">帳號：</td>
      <td width="272"><?php echo $row[0]; ?>
      <input name="mid" type="hidden" id="$mid" value="<?php echo $row[0]; ?>" /></td>
    </tr>
    <tr>
      <td align="right" style="text-align: center">姓名：</td>
      <td>
      <input name="name" type="text" id="$name" value="<?php echo $row[1]; ?>" /></td>
    </tr>
    <tr>
      <td align="right" style="text-align: center">性別：</td>
      <td>
      <input name="sex" type="text" id="$sex" value="<?php echo $row[2]; ?>" /></td>
    </tr>
    <tr>
      <td align="right" style="text-align: center">生日：</td>
      <td>
      <input name="birthday" type="text" id="$birthday" value="<?php echo $row[3]; ?>" /></td>
    </tr>
    <tr>
      <td align="right" style="text-align: center">電話：</td>
      <td>
      <input name="phone" type="text" id="$phone" value="<?php echo $row[4]; ?>" /></td>
    </tr>
    <tr>
      <td align="right" style="text-align: center">Email：</td>
      <td>
      <input name="email" type="text" id="$email" value="<?php echo $row[5]; ?>" /></td>
    </tr>
    <tr>
      <td height="89" align="right" style="text-align: center">操作</td>
      <td><p align="center"><input type="submit" value="修改">
      </p></td>
    </tr>
  
  </table>
  <iframe name="yframe" src="update2.php?mid=<?php echo $row_RecResult['mid']; ?>" width="450" height="450" style="border: none; text-align: center;"></iframe>

</form>
<a href="index.html" target=3><font size="10" face="標楷體" color=black>回會員檢視
</body>
</html>
<?php

?>



