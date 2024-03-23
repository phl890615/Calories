<?php include_once ("controller.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>忘記密碼</title>
    <link rel="stylesheet" href="css/forgot.css">
</head>

<body>
    <div id="container">
        <h2>確認Email(帳號)</h2>
        <p>請填寫帳號(Email).</p>
        <div id="line"></div>
        <form action="forgot.php" method="POST" autocomplete="off">
            <?php
            if ($errors > 0) {
                foreach ($errors as $displayErrors) {
            ?>
                    <div id="alert"><?php echo $displayErrors; ?></div>
            <?php
                }
            }
            ?>
            <input type="email" name="mem_email" placeholder="帳號(Email)"><br>
            <input type="submit" name="forgot_password" value="提交">
        </form>
    </div>
</body>

</html>