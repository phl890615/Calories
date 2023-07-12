<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<html lang="en">
<html>

<head>

  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">

  <meta charset="UTF-8">
  <meta name="viewport" content="user-scalable=0, width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <title>熱力適攝</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
  <div id="header">
    <h1><a href="index.html">WELCOME<span>熱力適攝</span></a></h1>
    <ul id="navigation">
      <li class="current">
        <a href="index.html">首頁</a>
      </li>
      <li>
        <a href="user.php">會員管理</a>
      </li>
      <li>
        <a href="video_view.php">影片管理</a>
        <ul>
          <li>
            <a href="videotext_add.php">管理者新增影片</a>
          </li>
        </ul>
      </li>
      <li>
        <a href="diet_plan.php">飲食計劃管理</a>
      </li>
      <li>
        <a href="video_msg.php">留言管理</a>
      </li>
    </ul>
  </div>
  <div id="body">
    <form action="video_add_update.php" method="POST" enctype="multipart/form-data">
      <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">影片編號:</span>
        <input type="text" name="diet_id" value="<?php echo $_GET['v_id'] ?>" class="form-control" aria-describedby="basic-addon1">
      </div>

      <div class="input-group mb-3">
        <input type="file" name="video_id[]" class="form-control" id="inputGroupFile02" accept="video/*" multiple>
      </div>

      <input type="submit" class="btn btn-success" name="submit" value="修改" onclick="return confirm('確定要修改嗎?')">
      <input type="button" class="btn btn-success" value="取消修改" onclick="location.href='video_revise.php?id=<?php echo $_GET['v_id']; ?>'">
    </form>
  </div>
  <div id="footer">
    <div>
      <span>110年專題組</span>
    </div>
  </div>
  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous"></script>
  -->
</body>

</html>