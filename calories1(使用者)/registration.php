<?php include_once ("controller.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>註冊頁面</title>
    <link rel="stylesheet" href="css/registration.css">
</head>
<body>
    <div id="container">
        <h2>註冊會員</h2>
        <p>請填寫以下資料註冊會員.</p>
        <div id="line"></div>
        <form action="registration.php" method="POST" autocomplete="off">
        <?php
            if($errors > 0){
                foreach($errors AS $displayErrors){
                ?>
                <div id="alert"><?php echo $displayErrors; ?></div>
                <?php
                }
            }
            ?> 
            <input type="text" name="mem_name"  placeholder="暱稱" required><br>
            <input type="email" name="mem_email" placeholder="帳號(Email)" required><br>
            <input type="password" name="mem_pwd" placeholder="密碼" required><br>
            <input type="password" name="mem_confirmPassword" placeholder="確認密碼" required><br>
            <input type="radio" name="mem_gender" id="0" value="0" required><label for="0">男</label>
            <input type="radio" name="mem_gender" id="1" value="1" required><label for="1">女</label>
            <input type="number" name="mem_phone" placeholder="電話" required><br>
            <input type="date" name="mem_bir" placeholder="生日" required><br>
            <input type="submit" name="signup" value="註冊">
        </form>
        <h3>已經有帳號了? <a href="login.php">登入</a></h3>
    </div>
</body>
</html>