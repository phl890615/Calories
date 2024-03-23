<!DOCTYPE html>
<html lang="en">
<script>
    function compute() {
        var idealweight = document.getElementById('idealweight').value;
        var idealdate = document.getElementById('idealdate').value;
        var weight = document.getElementById('weight').value;
        var tdee = document.getElementById('tdee').value;
        var lower = (weight * 1) - (idealweight * 1);
        var calorieintake = (tdee * 1) - ((7700 * lower) / idealdate);
        document.getElementById("lower").value = lower*-1;
        document.getElementById("calorieintake").value = calorieintake.toFixed(2);
    }
</script>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>熱力適攝</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
</head>

<body>
    <!-- 這是最上方導覽列 -->
    <?php
    include("connection.php");
    include("controller.php");

    $mem_phone = $_SESSION['mem_phone'];
    $sql = "SELECT * FROM member WHERE mem_phone = '$mem_phone'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if (isset($_POST['diet']) != '') {
        $diet = $_POST['diet'];
        $data = "SELECT * FROM diet_plan where diet_plan_id = $diet";
    } else {
        $data = "SELECT * FROM diet_plan";
    }
    $re = mysqli_query($conn, $data);
    $ro = mysqli_fetch_assoc($re);
    ?>
    <!DOCTYPE html>
    <!-- Website template by freewebsitetemplates.com -->
    <html>

    <head>
        <meta charset="UTF-8">
        <title>熱力適攝</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>

    <body>
        

        <div id="page">
            <div id="header">
                <a href="index.php" id="logo"><img src="images/logo3.png" alt="Logo"></a>
                <ul>
                    <li>
                        <a href="index.php">首頁</a>
                    </li>
                    <li>
                        <a href="membercentre.php">會員中心</a>
                        <ul>
                            <li>
                                <a href="userprofile.php">會員資料</a>
                            </li>
                            <li>
                                <a href="tdee.php">每日消耗熱量(TDEE)</a>
                            </li>
                            <li>
                                <a href="changepassword.php">修改密碼</a>
                            </li>
                            <li>
                                <a href="contactus.php">聯絡我們</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="weightrecord.php">體重紀錄</a>
                    </li>
                    <li>
                        <a href="video_view.php">影片分享</a>
                        <ul>
                            <li>
                                <a href="videotext_add.php">發佈影片</a>
                            </li>
                            <li>
                                <a href="video_my.php">我的影片</a>
                            </li>
                            <li>
                                <a href="video_like.php">我的最愛</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="diet-plan2.php">飲食計畫</a>
                    </li>
                    <li>
                        <a href="logout.php">登出</a>
                    </li>
                </ul>
            </div>
            <div id="body">

                <body>

                    <div align="center">
                        <hr>
                        <h1>飲食計畫</h1>
                        <hr>


                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="text-center">

                                    </div>
                                    <div class="cal26rd">
                                        <h5 class="card-title mt-3 ml-4 text-muted"></h5>
                                        <div class="form-group">
                                            <form id="form1" name="form1" method="post" action="">
                                                <h1><select style="font-size: 20px;" class="form-control" name="diet" required onchange="submit();" >
                                                        <option value="<?php if (isset($_POST['diet']) != '') {
                                                                            echo $ro['diet_plan_id'];
                                                                        } else {
                                                                            echo "";
                                                                        } ?>" disabled selected hidden>
                                                            <?php if (isset($_POST['diet']) != '') {
                                                                echo $ro['diet_plan_sort'];
                                                            } else {
                                                                echo "---請選擇---";
                                                            } ?></option>
                                                        <?php
                                                        include('connection.php');
                                                        $sql = "SELECT * FROM diet_plan";
                                                        $result = mysqli_query($conn, $sql);
                                                        $i = 1;
                                                        while ($i <= mysqli_num_rows($result)) {
                                                            $co = mysqli_fetch_row($result);
                                                            echo '<option value="', $co[0], '">', $co[1], '</option>';
                                                            $i++;
                                                        }
                                                        ?>
                                                    </select></h1>
                                            </form>

                                            <form method="POST" action="diet-plan1add.php">
                                                <?php
                                                if (isset($_POST['diet']) != '') {
                                                    $diet = $_POST['diet'];
                                                    $data = "SELECT * FROM diet_plan where diet_plan_id = $diet";
                                                    $se = mysqli_query($conn, $data);
                                                    $ss = mysqli_fetch_assoc($se);
                                                    $start = @$row['mem_start'];
                                                    
                                                    if ($ss['diet_plan_sort'] == "168間歇性斷食法") {
                                                        echo "<h3>預期用餐時間：</h3>
                                                                <div class='input-group mb-3'>
                                                                    <td><label for='name' style='font-size: 20px;' class='col-sm-4 col-form-label'>開始時間:</label><input type='time' style='font-size: 20px;' class='form-control' name='start' id='start' required value='$start' ></td>
                                                                </div>";
                                                    }
                                                }
                                                ?>
                                                <!-- Button trigger modal -->
        <button type="button" id="alert" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" hidden>

</button>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel" style="text-align:left;font-size: 28px;font-family:serif,sans-serif,cursive,fantasy,monospace;">提醒</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="text-align:left;font-size: 20px;font-family:serif,sans-serif,cursive,fantasy,monospace;">
                請輸入至少30天！
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
                
            </div>
        </div>
    </div>
</div>
                                                <input type="hidden" name="diet" id="diet" value="<?php if (isset($_POST['diet']) != '') {
                                                                                                            echo $diet;} 
                                                                                                    ?>" required readonly="readonly">
                                                <div class="input-group mb-3">
                                                    <label for="name" style='font-size: 20px; ' class="col-sm-4 col-form-label">每日消耗熱量:</label>
                                                    <input type="text" style='font-size: 20px;' class="form-control" value="<?php echo $row['mem_tdee'] ?>" readonly="readonly" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                                    <span class="input-group-text" style='font-size: 20px;' id="basic-addon2">卡</span>
                                                </div>
                                                <div class="form-group">
                                                    <td><input class="btn btn-outline-success" style=float:right; type="button" value="TDEE" onclick="location.href='tdee.php'" /></td><br>
                                                </div>
                                                <hr>

                                                <form method="POST" action="">
                                                    <input type="hidden" name="tdee" id="tdee" value="<?php echo $row['mem_tdee'] ?>" required readonly="readonly">

                                                    <h3>預期設定:</h3>

                                                    <input type="hidden" name="weight" id="weight" value="<?php echo $row['mem_weight'] ?>" required readonly="readonly">

                                                    <div class="input-group mb-3">
                                                        <label for="name" style='font-size: 20px;' class="col-sm-4 col-form-label">預期體重:</label>
                                                        <input type="text" style='font-size: 20px;' required name="idealweight" class="form-control" id="idealweight" value="<?php echo $row['mem_idealweight'] ?>" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                                        <span class="input-group-text" style='font-size: 20px;' id="basic-addon2">kg</span>
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <label for="floatingInputInvalid" style='font-size: 20px;' class="col-sm-4 col-form-label">預期體重時間:</label>
                                                        <input type="text" style='font-size: 20px;' required name="idealdate" class="form-control" id="idealdate" value="<?php echo $row['mem_idealdate'] ?>" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                                        <span class="input-group-text" style='font-size: 20px;' id="basic-addon2">天<br></span>
                                                        <div class="input-group mb-3" style='margin-left: 190px;color:#8FBC8F'>
                                                            *時間最少30天
                                                        </div>
                                                    </div>


                                                    <div class="form-group">
                                                        <input class="btn btn-outline-success" style=float:right; type="button" value="計算" onclick="compute()" /><br>
                                                    </div>
                                                    <hr>

                                                    <div class="input-group mb-3">
                                                        <label for="name" style='font-size: 20px;' class="col-sm-4 col-form-label">增減重:</label>
                                                        <input type="text" name="lower" style='font-size: 20px;' class="form-control" id="lower" value="<?php echo $row['mem_lower'] ?>" readonly aria-label="Recipient's username" aria-describedby="basic-addon2" required>
                                                        <span class="input-group-text" style='font-size: 20px;' id="basic-addon2">kg</span>
                                                    </div>

                                                    <div class="input-group mb-3">
                                                        <label for="name" style='font-size: 20px;' class="col-sm-4 col-form-label">每日應攝取熱量:</label>
                                                        <input type="text" name="calorieintake" style='font-size: 20px;' class="form-control" id="calorieintake" value="<?php echo $row['mem_calor'] ?>" readonly aria-label="Recipient's username" aria-describedby="basic-addon2" required>
                                                        <span class="input-group-text" style='font-size: 20px;' id="basic-addon2">卡</span>
                                                    </div>
                                                    <hr>


                                                    <h3>飲食偏好:</h3>

                                                    <?php
                                                    $fav = $row['mem_fav'];
                                                    if ($fav == 2) {
                                                        $fav = "葷食";
                                                    } else if ($fav == 1) {
                                                        $fav = "蛋奶素";
                                                    } else {
                                                        $fav = "全素";
                                                    }
                                                    ?>
                                                    <div class="form-group">
                                                        <select style="font-size: 20px;" required class="form-control" id="exampleFormControlSelect1" name="fav">
                                                            <option value="<?php echo $row['mem_fav'] ?>"><?php echo $fav ?></option>
                                                            <?php if ($fav != "葷食") echo "<option value='2'>葷食</option>"; ?>
                                                            <?php if ($fav != "蛋奶素") echo "<option value='1'>蛋奶素</option>"; ?>
                                                            <?php if ($fav != "全素") echo "<option value='0'>全素</option>"; ?>
                                                        </select>

                                                        <hr>
                                                        <h3>過敏:</h3>

                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name='glut' value='1' <?php if ($row['mem_allergy_glut'] == 1) echo "checked"; ?>>
                                                            <label class="form-check-label" for="inlineCheckbox1">麩質類</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name='milk' value='1' <?php if ($row['mem_allergy_milk'] == 1) echo "checked"; ?>>
                                                            <label class="form-check-label" for="inlineCheckbox1">奶類</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name='crust' value='1' <?php if ($row['mem_allergy_crust'] == 1) echo "checked"; ?>>
                                                            <label class="form-check-label" for="inlineCheckbox1">甲殼類</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name='fish' value='1' <?php if ($row['mem_allergy_fish'] == 1) echo "checked"; ?>>
                                                            <label class="form-check-label" for="inlineCheckbox1">魚類</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name='nut' value='1' <?php if ($row['mem_allergy_nut'] == 1) echo "checked"; ?>>
                                                            <label class="form-check-label" for="inlineCheckbox1">堅果類</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name='bean' value='1' <?php if ($row['mem_allergy_bean'] == 1) echo "checked"; ?>>
                                                            <label class="form-check-label" for="inlineCheckbox1">豆類</label>
                                                        </div>
                                                        <br>
                                                        <br><input class="btn btn-outline-success" style=float:right; type="submit" name="com" value="下一步" onclick="compute()" />
                                                        <br>
                                                </form>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
            <script type="text/javascript">
                $(document).ready(function() {

                    $("#idealdate").change(function() {
                        var date = $("#idealdate").val();
                        if (date < 30) {
                            $("#alert").click();
                            $("#idealdate").val(30);
                        }

                    });
                });
            </script>
    </body>

    </html>