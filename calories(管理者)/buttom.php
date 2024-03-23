<?php
include("connect.php");
$data = "select * from member";
$rs = mysqli_query($link, $data);
for ($i = 1; $i <= mysqli_num_rows($rs); $i++) {
  $co = mysqli_fetch_row($rs);
  $get_co;
  if ($co[9] == 0) $get_co = "正常";
  else $get_co = "封鎖";

?>
  <tr>
    <br />
    <td><?php echo $co[6] ?></td>
    <td><?php echo $co[5] ?></td>
    <td><?php echo $get_co ?></td>
    <td><?php echo  "<a href='videotext_add.php?phone=$co[5]'>修改</a>";
      }
        ?>