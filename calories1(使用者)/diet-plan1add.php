
<?php
    session_start();
    include('connection.php');//連結資料庫
    $phone = $_SESSION['mem_phone'];
    if(isset($_POST['diet'])!='' ){
        $diet = $_POST['diet'];
    }else{
        echo "<script>alert('別忘了選擇飲食法呦~');</script>";
        header("refresh:0;url=diet-plan1.php?");
    }
    $idealweight = $_POST['idealweight'];
    $idealdate = $_POST['idealdate'];
    $lower = $_POST['lower'];
    $calor = $_POST['calorieintake'];
    $fav = $_POST['fav'];
    if(isset($_POST['glut'])!='' ){
        $glut = $_POST['glut'];
    }else{
        $glut = 0;
    }
    if(isset($_POST['milk'])!='' ){
        $milk = $_POST['milk'];
    }else{
        $milk = 0;
    }
    if(isset($_POST['crust'])!='' ){
        $crust = $_POST['crust'];
    }else{
        $crust = 0;
    }
    if(isset($_POST['fish'])!='' ){
        $fish = $_POST['fish'];
    }else{
        $fish = 0;
    }
    if(isset($_POST['nut'])!='' ){
        $nut = $_POST['nut'];
    }else{
        $nut = 0;
    }
    if(isset($_POST['bean'])!='' ){
        $bean = $_POST['bean'];
    }else{
        $bean = 0;
    }
    if(isset($_POST['start'])!='' ){
        $start = $_POST['start'];
        $T = strtotime($start); //將時間的字串形式轉成時間戳記
        $T = strtotime("+8 hours", $T); //指定要對這個時間的加減計算
        $end = date("H:i:s", $T); //輸出成你要的格式
        $sql = "UPDATE member SET diet_plan_id ='$diet' ,mem_idealweight='$idealweight',mem_idealdate = '$idealdate',mem_calor = '$calor',mem_fav = '$fav',mem_allergy_glut ='$glut',mem_allergy_milk ='$milk',mem_allergy_crust ='$crust',mem_allergy_fish ='$fish',mem_allergy_nut ='$nut',mem_allergy_bean ='$bean',mem_lower='$lower' ,mem_start='$start' ,mem_end='$end' WHERE mem_phone = '$phone'";
    }else{
        $sql = "UPDATE member SET diet_plan_id ='$diet' ,mem_idealweight='$idealweight',mem_idealdate = '$idealdate',mem_calor = '$calor',mem_fav = '$fav',mem_allergy_glut ='$glut',mem_allergy_milk ='$milk',mem_allergy_crust ='$crust',mem_allergy_fish ='$fish',mem_allergy_nut ='$nut',mem_allergy_bean ='$bean',mem_lower='$lower' WHERE mem_phone = '$phone'";
    }
    $result = mysqli_query($conn,$sql);//執行sql
    if($result){
        header("refresh:0;url=diet-plan2.php?");
        exit;
    }else{
        echo "新增or修改錯誤";
    }
?>
