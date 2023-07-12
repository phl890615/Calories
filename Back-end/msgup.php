<?php
include('connect.php');
$id=$_POST['fav'];
echo $id;
//$id = $_POST['id'];
//echo $id;
//$plan=$_POST['diet_id'];
//$title=$_POST['title'];
//$cont=$_POST['cont'];
//$met=$_POST['met'];
//$fav=$_POST['fav'];
//$level=$_POST['level'];
//$sql="UPDATE video SET 
//    diet_plan_id='$plan' ,
//    video_title='$title', 
//    video_cont='$cont', 
//    video_method='$met'  
//    where video_id = $id ";
//if (!mysqli_query($link,$sql))
//{
//die('請把資料輸入完整');
//}
//echo "<script>alert('請上傳影片');</script>";
//mysqli_close($link)
?>
<tr>
            <td><div style="font-size:20px">飲食偏好：</div></td>
          <td><select name ="fav">
              <option value = "<?php $row['video_fav']; ?>"><?php if($row['video_fav']==0){ echo '素食';}elseif($row['video_fav']==1){ echo '蛋奶素';}else{ echo '葷食';}; ?></option>
              <option value = "0">素食</option>
              <option value = "1">蛋奶素</option>
              <option value = "2">葷食</option>
              </select></td>
        </tr>
        <tr>
            <td><div style="font-size:20px">影片內容：</div></td>
            <td><textarea type="text" name="cont" rows = 6><?php echo $row['video_cont']; ?></textarea></td>
        </tr>
        <tr>
            <td><div style="font-size:20px">影片方法：</div></td>
          <td><input type="text" name="met" value="<?php echo $row['video_method']; ?>"></td>
        </tr>
        <tr>
            <td><div style="font-size:20px">麩質過敏：</div></td>
            <td><select name ="glut">
              <option value = "<?php $row['video_allergy_glut']; ?>"><?php echo $row['video_allergy_glut']; ?></option>
              <option value = "0">正常</option>
              <option value = "1">過敏</option>
              </select></td>
        </tr>
        <tr>
            <td><div style="font-size:20px">製作難度：</div></td>
          <td><select name ="level">
              <option value = "1">毫無難度</option>
              <option value = "2">新手</option>
              <option value = "3">普通</option>
              <option value = "4">稍難</option>
              <option value = "5">困難</option>
              </select></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>