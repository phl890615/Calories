<?php include_once ("controller.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>重設密碼</title>
    <link rel="stylesheet" href="css/forgot.css">
</head>
<body>
<div id="container">
        <h2>密碼</h2>
        <p>請重設您的密碼.</p>
        <div id="line"></div>
        <form action="newPassword.php" method="POST" autocomplete="off">
            <?php
            if ($errors > 0) {
                foreach ($errors as $displayErrors) {
            ?>
                    <div id="alert"><?php echo $displayErrors; ?></div>
            <?php
                }
            }
            ?>
            <input type="password" name="mem_pwd" placeholder="密碼" required><br>
            <input type="password" name="mem_confirmPassword" placeholder="確認密碼" required><br>
            <input type="submit" name="changePassword" value="提交">
        </form>
    </div>
</body>
</html>