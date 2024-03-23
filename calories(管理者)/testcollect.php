<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>收藏功能</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">

  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

</head>

<body>
  <div class="container">
    <button type="button" class="btn btn-primary" id="btn_collect">
      收藏
    </button>
  </div>


  <script>
    $(document).ready(function() {
      $("button[id^='btn_collect']").click(function() {
        var id = '0970131296';
        var v_id = $(this).val();
        var classname = $(this).attr("class");
        $(this).removeClass("btn btn-primary btn btn-success");
        if (classname == "btn btn-primary") {
          $(this).addClass("btn btn-success");
          alert("收藏成功");
          $.ajax({
            url: 'video_like_insert.php',
            type: 'POST',
            data: 'id=' + id + '&v_id=' + '213',
            success: function(result) {
              console.log(result);
            },
            error: function(xhr) {
              alert('Ajax request 發生錯誤');
            }
          });
        } else {
          $(this).addClass("btn btn-primary");
          alert("取消收藏");
          $.ajax({
            url: 'video_like_delet.php',
            type: 'POST',
            data: 'id=' + id + '&v_id=' + '213',
            success: function(result) {
              console.log(result);
            },
            error: function(xhr) {
              alert('Ajax request 發生錯誤');
            }
          });
        }
      });
    });
  </script>
</body>

</html>