<?php
if(isset($_POST["com"])){
    include('connect.php');//連結資料庫
    $sort = $_POST['sort'];//post獲得名稱
    $sum = $_POST['sum'];//post獲得簡介
    $adv = $_POST['adv'];//post獲得優點
    $dis = $_POST['dis'];//post獲得缺點
    $food = $_POST['food'];//post獲得食物類型
    $sup = $_POST['sup'];//post獲得注意事項
    $sql = "INSERT INTO diet_plan(diet_plan_sort, diet_plan_sum, diet_plan_adv, diet_plan_dis, diet_plan_food, diet_plan_sup) VALUES ('$sort', '$sum', '$adv', '$dis', '$food','$sup')ON DUPLICATE KEY UPDATE diet_plan_sum ='$sum',diet_plan_adv = '$adv',diet_plan_dis = '$dis',diet_plan_food = '$food',diet_plan_sup ='$sup'";
    $result = mysqli_query($link,$sql);//執行sql
    if($result){
        header("refresh:0;url=diet_plan.php");
        exit;
    }else{
        echo "新增or修改錯誤";
    }

}
if(isset($_POST["del"])){
    include('connect.php');//連結資料庫
    $id = $_POST['id'];//post獲得名稱
    $sql = "DELETE FROM diet_food where diet_plan_id = '$id'";
    $result = mysqli_query($link,$sql);//執行sql
    if($result){
        $sql = "DELETE FROM diet_plan where diet_plan_id = '$id'";
        $result = mysqli_query($link,$sql);//執行sql
        if($result){
        header("refresh:0;url=diet_plan.php");
        exit;
        }else{
        echo "刪除錯誤";
        }
    }
}
?>
 