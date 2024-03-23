
<?php
include_once("controller.php");


    $mem_email = $_POST['email'];
    $weight = $_POST['weight'];
    $rdate = $_POST['rdate'];
    $phone = $_POST['phone'];
//	mem_phone 會員手機	weight_day 日期	weight_record 每日體重

	$sql1 = "SELECT * FROM weight WHERE mem_phone = '$phone' and weight_day='$rdate'";
	$result1 = mysqli_query($conn,$sql1);
	
	if (mysqli_num_rows($result1) != 0)
	{
		$sql = "UPDATE weight SET weight_record='$weight' WHERE mem_phone = '$phone' and weight_day='$rdate'";
		
		$query = mysqli_query($conn,$sql);

		if(!$query){
			echo("Error:".mysqli_error($conn));
				 exit();
		}
	}
	else
	{
		$sql = "INSERT INTO weight(mem_phone, weight_day, weight_record) VALUES ('$phone','$rdate','$weight')";
    
		$query = mysqli_query($conn,$sql);

		if(!$query){
			echo("Error:".mysqli_error($conn));
				 exit();
		}
	}
	list($year,$month,$day) = explode("-",$rdate);
    
    
    header("Location: weightrecord.php?year=$year&month=$month");
    die();
?>

