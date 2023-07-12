<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<html>

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">

	<meta charset="UTF-8">
	<meta name="viewport" content="user-scalable=0, width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>熱力適攝</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/mobile.css">
	<script type='text/javascript' src='js/mobile.js'></script>
</head>

    <?php
    $fav = "葷食";
    ?>
    <select name="fav"> 
        <option value="" ><?php echo $fav;?></option> 
        <?php if($fav != "葷食") echo "<option value='2'>葷食</option>"; ?>
        <?php if($fav != "蛋奶素") echo "<option value='1'>蛋奶素</option>"; ?>
        <?php if($fav != "全素") echo "<option value='0'>全素</option>"; ?>
    </select>

</html>