
<?php

include_once("connection.php");
// Connection Created Successfully
session_start();
error_reporting(E_ALL);

// Store All Errors
$errors = [];


// When Sign Up Button Clicked
if (isset($_POST['signup'])) {

    $mem_name = mysqli_real_escape_string($conn, $_POST['mem_name']);
    $mem_email = mysqli_real_escape_string($conn, $_POST['mem_email']);
    $mem_phone = mysqli_real_escape_string($conn, $_POST['mem_phone']);
    $mem_bir = date('Y-m-d', strtotime($_POST['mem_bir']));
    $mem_gender = mysqli_real_escape_string($conn, $_POST['mem_gender']);
    $hash_pwd=hash('sha256',  $_POST['mem_pwd']);
    // check password length if password is less then 8 character so
    if (strlen(trim($_POST['mem_pwd'])) < 6) {
        $errors['mem_pwd'] = '請使用6個以上的數字、字母、符號所組成的密碼';
    } else {
        // if password not matched so
        if ($_POST['mem_pwd'] !== $_POST['mem_confirmPassword']) {
            $errors['mem_pwd'] = '密碼並不相符';
        } else {
            $mem_pwd = $hash_pwd;
        }
    }
    // generate a random Code
    //$mem_code = rand(999999, 111111);
    // set Status
    //$mem_status = "Not Verified";

    // echo 'first name = ' .$fname . "<br> last name = " .$lname . "<br> email = " .$email . "<br> password = " .$password . "<br> gender = " .$gender . "<br>";

    // check email validation and save information
    $sql = "SELECT * FROM member WHERE mem_email = '$mem_email' ";
    $res = mysqli_query($conn, $sql) or die('查詢失敗');
    if (mysqli_num_rows($res) > 0) {
        $errors['mem_email'] = '此Email已被註冊';
    }

    $sql = "SELECT * FROM member WHERE mem_phone = '$mem_phone' ";
    $res = mysqli_query($conn, $sql) or die('查詢失敗');
    if (mysqli_num_rows($res) > 0) {
        $errors['mem_phone'] = '此電話已被註冊';
    }

    // count erros
    if (count($errors) === 0) {
        $insertQuery = "INSERT INTO member (mem_name,mem_gender,mem_bir,mem_phone,mem_email,mem_pwd)
            VALUES ('$mem_name','$mem_gender','$mem_bir','$mem_phone','$mem_email','$mem_pwd')";
        $insertInfo = mysqli_query($conn, $insertQuery);
        if ($insertInfo) {
            header('location: login.php');
        } else {
            $errors['db_errors'] = "將資料寫入資料庫失敗!";
        }
    }


    // count erros
    //if (count($errors) === 0) {
        //$insertQuery = "INSERT INTO member (mem_name,mem_gender,mem_bir,mem_phone,mem_email,mem_pwd,mem_code,mem_status)
            //VALUES ('$mem_name','$mem_gender','$mem_bir','$mem_phone','$mem_email','$mem_pwd', $mem_code, '$mem_status')";
        //$insertInfo = mysqli_query($conn, $insertQuery);

        // Send Varification Code In Gmail
        //if ($insertInfo) {
            // Configure Your Server To Send Mail From Local Host Link In Video Description (How To Config LocalHost Server)
            //$subject = 'Email 驗證碼';
            //$message = "我們的驗證碼是 $mem_code";
            //$sender = 'From: g0987149050@gmail.com';

            //if (mail($mem_email, $subject, $message, $sender)) {
                //$message = "我們已經將驗證碼發送到您的Email <br> $mem_email";

                //$_SESSION['message'] = $message;
               // header('location: otp.php');
            //} else {
                //$errors['otp_errors'] = '發送代碼失敗';
            //}
        //} else {
           // $errors['db_errors'] = "將資料寫入資料庫失敗!";
        //}
    //}
}


// if Verify Button Clicked
//if (isset($_POST['verify'])) {
    //$_SESSION['message'] = "";
    //$otp = mysqli_real_escape_string($conn, $_POST['otp']);
    //$otp_query = "SELECT * FROM member WHERE mem_code = $otp";
    //$otp_result = mysqli_query($conn, $otp_query);

   // if (mysqli_num_rows($otp_result) > 0) {
        //$fetch_data = mysqli_fetch_assoc($otp_result);
        //$fetch_code = $fetch_data['mem_code'];

        //$update_code = 0;
        //$update_status = "Verified";

       // $update_query = "UPDATE member SET mem_status = '$update_status' , mem_code = $update_code WHERE mem_code = $fetch_code";
       // $update_result = mysqli_query($conn, $update_query);

        //if ($update_result) {
            //header('location: login.php');
        //} else {
            //$errors['db_error'] = "無法在資料庫中插入資料";
        //}
    //} else {
        //$errors['otp_error'] = "您輸入一個無效的驗證碼";
    //}
//}

// if login Button clicked so

if (isset($_POST['login'])) {
    $mem_email = mysqli_real_escape_string($conn, $_POST['mem_email']);
    $hash_pwd=hash('sha256',  $_POST['mem_pwd']);
    $mem_pwd = $hash_pwd;

    $emailQuery = "SELECT * FROM member WHERE mem_email = '$mem_email'";
    $email_check = mysqli_query($conn, $emailQuery);

    if (mysqli_num_rows($email_check) > 0) {
        
        $passwordQuery = "SELECT * FROM member WHERE mem_email = '$mem_email' AND mem_pwd = '$mem_pwd'";
        $password_check = mysqli_query($conn, $passwordQuery);
        if (mysqli_num_rows($password_check) > 0) {
            $fetchInfo = mysqli_fetch_assoc($password_check);
            //$mem_status = $fetchInfo['mem_status'];
            $mem_id = $fetchInfo['mem_id'];
            $_SESSION['mem_id'] = $mem_id;
            $mem_phone = $fetchInfo['mem_phone'];
            $_SESSION['mem_phone'] = $mem_phone;
            $mem_name = $fetchInfo['mem_name'];
            $_SESSION['mem_name'] = $mem_name;
            $mem_picture = $fetchInfo['mem_picture'];
            $_SESSION['mem_picture'] = $mem_picture;
            $_SESSION['mem_email'] = $fetchInfo['mem_email'];
            $_SESSION['mem_pwd'] = $fetchInfo['mem_pwd'];
            //if ($mem_status === 'Verified') {
                //$_SESSION['mem_picture'] = $fetchInfo['mem_picture'];
            header('location: index.php');
            //} else {
                //$info = "您還沒有驗證您的Email $mem_email";
                //$_SESSION['message'] = $info;
                //header('location: otp.php');
            //}
        } else {
            $errors['mem_pwd'] = '密碼並不符合';
        }
    } else {
        $errors['mem_email'] = '無效的電子信箱';
    }
 }

// if forgot button will clicked
if (isset($_POST['forgot_password'])) {
    $mem_email = $_POST['mem_email'];
    $_SESSION['mem_email'] = $mem_email;

    $emailCheckQuery = "SELECT * FROM member WHERE mem_email = '$mem_email'";
    $emailCheckResult = mysqli_query($conn, $emailCheckQuery);

    // if query run
    if ($emailCheckResult) {
        // if email matched
        if (mysqli_num_rows($emailCheckResult) > 0) {
            header("location: newPassword.php");
            //$mem_code = rand(999999, 111111);
            //$updateQuery = "UPDATE member SET mem_code = $mem_code WHERE mem_email = '$mem_email'";
            //$updateResult = mysqli_query($conn, $updateQuery);
            //if ($updateResult) {
                //$subject = 'Email驗證碼';
                //$message = "我們的驗證碼是 $mem_code";
                //$sender = 'From: g0987149050@gmail.com';

                //if (mail($mem_email, $subject, $message, $sender)) {
                    //$message = "我們已將驗證碼發送至您的電子郵箱 <br> $mem_email";

                    //$_SESSION['message'] = $message;
                    //header('location: verifyEmail.php');
                //} else {
                    //$errors['otp_errors'] = '發送代碼失敗！';
                //}
            //} else {
                //$errors['db_errors'] = "將資料插入資料庫失敗";
            //}
        } else {
            $errors['invalidEmail'] = "無效的Email";
        }
    } else {
        $errors['db_error'] = "從資料庫檢查Email失敗";
    }
}

//if (isset($_POST['verifyEmail'])) {
    //$_SESSION['message'] = "";
    //$OTPverify = mysqli_real_escape_string($conn, $_POST['OTPverify']);
    //$verifyQuery = "SELECT * FROM member WHERE mem_code = $OTPverify";
    //$runVerifyQuery = mysqli_query($conn, $verifyQuery);
    //if ($runVerifyQuery) {
        //if (mysqli_num_rows($runVerifyQuery) > 0) {
            //$newQuery = "UPDATE member SET mem_code = 0";
            //$run = mysqli_query($conn, $newQuery);
            //header("location: newPassword.php");
        //} else {
            //$errors['verification_error'] = "無效的驗證碼";
        //}
    //} else {
        //$errors['db_error'] = "檢查驗證碼失敗";
    //}
//}

// change Password
if (isset($_POST['changePassword'])) {
    $mem_confirmPassword = ($_POST['mem_confirmPassword']);
    $hash_pwd=hash('sha256',  $_POST['mem_pwd']);
    $mem_pwd = $hash_pwd;
    if (strlen($_POST['mem_pwd']) < 6) {
        $errors['password_error'] = '請使用6個以上的數字、字母、符號所組成的密碼';
    } else {
        // if password not matched so
        if ($_POST['mem_pwd'] !== $_POST['mem_confirmPassword']) {
            $errors['password_error'] = '密碼並不相同';
        } else {
            $mem_email = $_SESSION['mem_email'];
            $updatePassword = "UPDATE member SET mem_pwd = '$mem_pwd' WHERE mem_email = '$mem_email'";
            $updatePass = mysqli_query($conn, $updatePassword) or die("Query Failed");
            session_unset();
            session_destroy();
            header('location: login.php');
        }
    }
}


if (isset($_POST['update'])) {
    $mem_name  =    $_POST['mem_name'];
    $mem_gneder  =    $_POST['mem_gender'];
    $mem_bir =  date('Y-m-d', strtotime($_POST['mem_bir']));
    $mem_picture    =   $_FILES['mem_picture'];
    $mem_phone = $_SESSION['mem_phone'];
    if ($_FILES['mem_picture']['name'] != null) {

        $imageName = $mem_picture['name'];
        $fileType  = $mem_picture['type'];
        $fileSize  = $mem_picture['size'];
        $fileTmpName = $mem_picture['tmp_name'];
        $fileError = $mem_picture['error'];

        $fileImageData = explode('/', $fileType);
        $fileExtension = $fileImageData[count($fileImageData) - 1];
        $mem_phone1 = $mem_phone . '.' . $fileExtension;

        if ($fileExtension == 'jpg' || $fileExtension == 'png' || $fileExtension == 'jpeg' || $fileExtension == 'jfif') {
            //Process Image

            if ($fileSize < 5000000) {
                //var_dump(basename($imageName));
                $fileNewName = "public/mempicture/" . $mem_phone1;


                $uploaded = move_uploaded_file($fileTmpName, $fileNewName);


                if ($uploaded || (count($errors) === 0)) {

                    $updateQuery = "UPDATE member SET mem_name = '$mem_name', mem_gender = '$mem_gneder', mem_bir = '$mem_bir', mem_picture='$mem_phone1' WHERE mem_phone = '$mem_phone'";

                    $results = mysqli_query($conn, $updateQuery);

                    header('Location:userprofile.php?success=userUpdated');
                    exit;
                }
            } else {
                header('Location:userprofile.php?error=invalidFileSize');
                exit;
            }
            exit;
        } else {
            header('Location:userprofile.php?error=invalidFileType');
            exit;
        }
    }else{
        $updateQuery = "UPDATE member SET mem_name = '$mem_name', mem_gender = '$mem_gneder', mem_bir = '$mem_bir'  WHERE mem_phone = '$mem_phone'";

        $results = mysqli_query($conn, $updateQuery);
        header('Location:userprofile.php?success=userUpdated');
        exit;
    }
}

// changepassword
if (isset($_POST['changepassword'])) {
    $hash_pwd=hash('sha256',  $_POST['oldpassword']);
    $new_hash_pwd=hash('sha256',  $_POST['newpassword']);
    $oldpass = $hash_pwd;
    $newpass = $_POST['newpassword'];
    $confirmpass = $_POST['confirmpassword'];
    $mem_email = $_SESSION['mem_email'];

    if (strlen($newpass) < 6) {
        $errors['changepassword_error'] = '請使用6個以上的數字、字母、符號所組成的密碼';
    } else {
        $sql = "SELECT * FROM member WHERE mem_pwd = '$oldpass' AND mem_email = '$mem_email'";
        $query = mysqli_query($conn, $sql);

        if ($oldpass !== null and $newpass !== null and $confirmpass !== null) {
            if ($newpass == $confirmpass) {

                if (!mysqli_num_rows($query) > 0) {
                    $errors['changepassword_error'] = '原密碼錯誤';
                } else {

                    $update = "UPDATE member SET mem_pwd = '$new_hash_pwd' WHERE mem_email = '$mem_email'";
                    $res = mysqli_query($conn, $update);

                    if ($res) {
                        echo "密碼修改成功 \n";
                        session_unset();
                        session_destroy();
                        header('location: login.php');
                    } else {
                        $errors['changepassword_error'] = "請重新輸入";
                    }
                }
            } else {
                $errors['changepassword_error'] = "密碼與確認密碼不一致";
            }
        } else {
            $errors['changepassword_error'] = "原密碼、新密碼、確認密碼不可空白";
        }
    }
}

?>


