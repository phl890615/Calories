
<?php
    
    include('controller.php');
    include('connection.php');//連結資料庫
    $phone = $_SESSION['mem_phone'];
    //$phone = $_POST['phone'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $birthday = $_POST['birthday'];
    $sport = $_POST['sports'];
    $BMR = $_POST['BMR'];
    $TDEE = $_POST['TDEE'];
    $sql = "UPDATE member SET mem_height='$height',mem_weight = '$weight',mem_bir = '$birthday',mem_exercise ='$sport',mem_bmr ='$BMR',mem_tdee ='$TDEE' WHERE mem_phone = '$phone'";
    $result = mysqli_query($conn,$sql);//執行sql
    if($result){
        echo "<script>alert('儲存成功');location.href='tdee.php';</script>";
        exit;
    }else{
        echo "新增or修改錯誤";
    }
?>
