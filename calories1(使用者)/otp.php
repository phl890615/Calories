<?php include_once ("controller.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>輸入驗證碼</title>
    <link rel="stylesheet" href="css/otp.css">
</head>
<body>
    <div id="container">
        <h2>註冊會員</h2>
        <p>請填寫發送的驗證碼</p>
        <div id="line"></div>
        <form action="" method="POST" autocomplete="off">
            <?php
            if(isset($_SESSION['message'])){
                ?>
                <div id="alert"><?php echo $_SESSION['message']; ?></div>
                <?php
            }
            ?>

            <?php
            if($errors > 0){
                foreach($errors AS $displayErrors){
                ?>
                <div id="alert"><?php echo $displayErrors; ?></div>
                <?php
                }
            }
            ?>      
            <input type="number" name="otp" placeholder="驗證碼" required><br>
            <input type="submit" name="verify" value="提交">
        </form>
    </div>
</body>
</html>