<?php
include("connect.php");
$sql = "SELECT * FROM member";
$result = mysqli_query($link, $sql) or die('MySQL connect error');
     
//判斷表單是否按送出而執行修改
if((isset($_POST['modify'])) && ($_POST['modify']=='yes')){
    //$id=$_POST['mem_id'];
    $name=$_POST['mem_name'];
    $sql="UPDATE member SET mem_name='$name'where mem_id=$_GET['id']";
    $result=mysqli_query($link, $sql) or die('MySQL insert error');
    mysqli_close($link);
    header("Location: index.html"); //修改後前往某網頁
} 
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>修改會員資料</title>
</head>
<body>
 <div>
   <?php while($row=mysqli_fetch_assoc($result)){ ?>
   <form method="post" name="form">
      <table align="center">
        <tr>
          <td>會員名稱：</td>
          <td><input type="text" name="mem_name" value="<?php echo $row['mem_name']; ?>"></td>
        </tr>
        <tr>
          <td>會員電話：</td>
          <td><input type="text" name="phone" value="<?php echo $row['mem_phone']; ?>"></td>
        </tr>
          <tr>
          <td>會員體重：</td>
          <td><input type="text" name="weight" value="<?php echo $row['mem_weight']; ?>"></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><input type="reset" value="重設"><input type="submit" value="確定"></td>
        </tr>
      </table>
      <input name="modify" type="hidden" value="yes"><? //隱藏欄位用來判斷是否送出,來做修改的動作 ?>
      <input name="id" type="hidden" value="<?php echo $_GET['phone']; //記錄篩選條件 ?>">
   </form>
   <?php } ?>
</div>
</body> 
</html>