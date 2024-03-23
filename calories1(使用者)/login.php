<?php 
include_once ("controller.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登入頁面</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
<div id="container">
<h2>登入會員</h2>
        <p>請填寫帳號密碼登入.</p>
        <div id="line"></div>
        <form action="login.php" method="POST" autocomplete="off">
        <?php
            if($errors > 0){
                foreach($errors AS $displayErrors){
                ?>
                <div id="alert"><?php echo $displayErrors; ?></div>
                <?php
                }
            }
            ?>
            <input type="email" name="mem_email" placeholder="帳號(Email)"><br>
            <input type="password" name="mem_pwd" placeholder="密碼"><br>
            <input type="submit" name="login" value="登入">
            <a href="forgot.php" id="forgot">忘記密碼?</a>
            <h3>還沒有帳號? <a href="registration.php">註冊</a></h3>
        </form> 
</div>    
</body>
</html>