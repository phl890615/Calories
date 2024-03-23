<?php
include('connect.php');
$diet_id = $_POST['diet_id'];
$j = 0;
for ($i = 0; $i < 100; $i++) {

  if (file_exists('../video/' . $diet_id . '.mp4')) {
    $j += 1;
  }
}
echo '當前id:' . $diet_id;
?>
<?php
include('connect.php');
if (isset($_POST["submit"])) {
  # 取得上傳檔案數量
  $fileCount = count($_FILES['video_id']['name']);
  for ($i = 0; $i < $fileCount; $i++) {
    # 檢查檔案是否上傳成功
    if ($_FILES['video_id']['error'][$i] === UPLOAD_ERR_OK) {
      //echo '檔案名稱: ' . $_FILES['video_id']['name'][$i] . '<br/>';
      //echo '檔案類型: ' . $_FILES['video_id']['type'][$i] . '<br/>';
      //echo '檔案大小: ' . ($_FILES['video_id']['size'][$i] / 1024) . ' KB<br/>';
      //echo '暫存名稱: ' . $_FILES['video_id']['tmp_name'][$i] . '<br/>';

      # 檢查檔案是否已經存在
      if (file_exists('../video/' . $_FILES['video_id']['name'][$i])) {
        //echo '檔案已存在。<br/>';
      } else {
        $file = $_FILES['video_id']['name'][$i];
        $ofile = $_FILES['video_id']['tmp_name'][$i];

        $id = $diet_id; //抓f_id值放入變數
        $name = 'mp4'; //將檔名以'.'分割得到字尾名,得到一個數組
        $newPath = $id . '.' . $name; //得到一個新的檔案為'f_id.(副檔名)',即新的路徑
        $oldPath = $ofile; //臨時資料夾,即以前的路徑
        rename($oldPath, "../video/$newPath"); //就可以重新命名及移動檔案至指定資料夾
        $j += 1;
      }
    } else {
      echo '錯誤代碼：' . $_FILES['video_id']['error'] . '<br/>';
    }
  }
  setcookie("diet_id", "", time() - 3600);
  echo "<script>alert('您已成功修改影片');location.href='video_revise.php?id=$diet_id';</script>";
}
