
<?php
include_once("connection.php");
if($_REQUEST['diet_plan_id']) {
	$sql = "SELECT diet_plan_id, diet_plan_sort, diet_plan_sum, diet_plan_adv, diet_plan_dis, diet_plan_food FROM diet_plan 
WHERE diet_plan_id='".$_REQUEST['diet_plan_id']."'";
	$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));	
	$dietData = array();
	while( $rows = mysqli_fetch_assoc($resultset) ) {
		$dietData = $rows;
	}
	echo json_encode($dietData);
} else {
	echo 0;	
}
?>
