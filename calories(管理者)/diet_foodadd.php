<?php
include('connect.php');
$id = $_POST["id"]; 
if(!empty($_POST["add"])){
    if(($_POST['egg'])!='' ){
        $egg = $_POST['egg'];
        $sql = "INSERT INTO diet_food(diet_plan_id, diet_food_type, diet_food_items) VALUES ('$id', '0', '$egg')";
    }else if(($_POST['bean'])!='' ){
        $bean = $_POST['bean'];
        $sql = "INSERT INTO diet_food(diet_plan_id, diet_food_type, diet_food_items) VALUES ('$id', '1', '$bean')";
    }else if(($_POST['fish'])!='' ){
        $fish = $_POST['fish'];
        $sql = "INSERT INTO diet_food(diet_plan_id, diet_food_type, diet_food_items) VALUES ('$id', '2', '$fish')";
    }else if(($_POST['meat'])!='' ){
        $meat = $_POST['meat'];
        $sql = "INSERT INTO diet_food(diet_plan_id, diet_food_type, diet_food_items) VALUES ('$id', '3', '$meat')";
    }else if(($_POST['milk'])!='' ){
        $milk = $_POST['milk'];
        $sql = "INSERT INTO diet_food(diet_plan_id, diet_food_type, diet_food_items) VALUES ('$id', '4', '$milk')";
    }else if(($_POST['glut'])!='' ){
        $glut = $_POST['glut'];
        $sql = "INSERT INTO diet_food(diet_plan_id, diet_food_type, diet_food_items) VALUES ('$id', '5', '$glut')";
    }else if(($_POST['vege'])!='' ){
        $vege = $_POST['vege'];
        $sql = "INSERT INTO diet_food(diet_plan_id, diet_food_type, diet_food_items) VALUES ('$id', '6', '$vege')";
    }else if(($_POST['fruit'])!='' ){
        $fruit = $_POST['fruit'];
        $sql = "INSERT INTO diet_food(diet_plan_id, diet_food_type, diet_food_items) VALUES ('$id', '7', '$fruit')";
    }else if(($_POST['wine'])!='' ){
        $wine = $_POST['wine'];
        $sql = "INSERT INTO diet_food(diet_plan_id, diet_food_type, diet_food_items) VALUES ('$id', '8', '$wine')";
    }else{
        echo "<script>alert('請輸入食物');</script>";
        header("refresh:0;url=diet_food.php?id=$id");
        exit; 
    }
    $result = mysqli_query($link,$sql);
    if($result){
        header("refresh:0;url=diet_food.php?id=$id");
        exit;
    }else{
        echo "新增or修改錯誤";
    }
}
if(isset($_POST["del"])){
    if(!empty($_POST["checkbox"])){
        $check=$_POST['checkbox'];
        foreach($check as $food){
        $sql = "DELETE FROM diet_food where diet_plan_id = '$id' and diet_food_items = '$food'";
        $result = mysqli_query($link,$sql);//執行sql
        }
        if($result){
            header("refresh:0;url=diet_food.php?id=$id");
            exit;
        }else{
            echo "刪除錯誤";
        } 
    }else{
        echo "<script>alert('請選擇要刪除的食物');</script>";
        header("refresh:0;url=diet_food.php?id=$id");
        exit;
    }
    
}

?>
 