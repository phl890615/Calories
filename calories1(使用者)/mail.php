<?php
include("PHPMailer/class.phpmailer.php");
date_default_timezone_set('Asia/Taipei');
mb_internal_encoding('UTF-8');

$mail= new PHPMailer(); 

// Server 資訊
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = "ssl";
$mail->Host = "smtp.gmail.com";
$mail->Port = 465;
$mail->CharSet = "utf-8";

// 登入
$mail->Username = ""; //帳號
$mail->Password = ""; //密碼

// 寄件者
$mail->From = ""; //寄件者信箱
$mail->FromName = "管者者"; //寄件者姓名
//$mail->ConfirmReadingTo = "your_gmail_account@gmail.com"; // 讀取回條 (對 Gmail 沒啥用)

// 郵件資訊
$mail->Subject = "Calories驗證碼"; //設定郵件標題
$mail->IsHTML(true); //設定郵件內容為HTML

function send_mail($mail_address, $name, $body)
{
	global $mail;
	$mail->Body = $body;
	$mail->ClearAddresses();
	$mail->AddAddress($mail_address,$name); //新稱收件者 (郵件及名稱)
	//$mail->AddCC("some_other one@gmail.com", "Someone"); // 新稱副本收件者

	if(!$mail->Send()) {
		echo "Error: " . $mail->ErrorInfo . "\n";
	} else {
		echo "Send To: " . $mail_address . "\n";
	}
}

?>
