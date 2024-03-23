<?php include_once("controller.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>熱力適攝</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<style>
	    html, body{
	      padding: 0;
	      margin: 0;
	    }
	    #myChart{
	      margin: auto;
	      margin-top: 50px;
	      /* background: #f9e498; */
	      display: block;
	    }
	  </style>
	<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
</head>

<!DOCTYPE html>

<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<title>熱力適攝</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	
</head>
<body>
	<div id="page">
		<div id="header">
		<a href="index.php" id="logo"><img src="images/logo3.png" alt="Logo"></a>
		<ul>
				<li>
					<a href="index.php">首頁</a>
				</li>
				<li>
					<a href="membercentre.php">會員中心</a>
					<ul>
						<li>
							<a href="userprofile.php">會員資料</a>
						</li>
						<li>
							<a href="tdee.php">每日消耗熱量(TDEE)</a>
						</li>
						<li>
							<a href="changepassword.php">修改密碼</a>
						</li>
						<li>
							<a href="contactus.php">聯絡我們</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="weightrecord.php">體重紀錄</a>
				</li>
				<li>
					<a href="video_view.php">影片分享</a>
					<ul>
						<li>
							<a href="videotext_add.php">發佈影片</a>
						</li>
						<li>
							<a href="video_my.php">我的影片</a>
						</li>
						<li>
							<a href="video_like.php">我的最愛</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="diet-plan2.php">飲食計畫</a>
				</li>
				<li>
					<a href="logout.php">登出</a>
				</li>
			</ul>
			</div>
        <div align="center">
		<div id="body">
       <hr>
	   <td >
                
				<h1 style="float:center; width:500px;">體重曲線圖
				<a href="javascript:history.back()" style="float:left;" title="back"><img src="../picture/back.png" border="0" width="40"></a></h1>
				
				</td>
				
		   
		   <hr>
	   
	   <canvas id="myChart" width="600px" height="400px"></canvas></body>
	   <script>

var data = [
<?php
		  $mem_phone = $_SESSION['mem_phone'];
		  $sql = "SELECT mem_phone,mem_height,mem_weight,mem_bir,mem_gender FROM member WHERE mem_phone = '$mem_phone'";
		  $result = mysqli_query($conn,$sql);
		  $row = mysqli_fetch_assoc($result);
		  
		  $phone = $row['mem_phone'];
		  
		  $year=$_GET['year'];
		  $month=$_GET['month'];
		  $list=array();
	  $data="";
	  
	  $cdays=0;
	  $zero=1;
	  
	  if ($month==1 || $month==3 || $month==5 || $month==7 || $month==8
				  || $month==10 || $month==12)
	  {
		  $cdays=31;
	  }
	  else if ($month==2)
	  {
		  $cdays=28;
	  }
	  else if ($month==4 || $month==6 || $month==9 || $month==11)
	  {
		  $cdays=30;
	  }
	  $first=1;
	  for($d=1; $d<=$cdays; $d++)
	  {
		  $time=mktime(12, 0, 0, $month, $d, $year);          
		  
		  if (date('m', $time)==$month)       
		  {
		  $days=date('Y-m-d', $time);
		  $sqls = "SELECT weight_record FROM weight WHERE mem_phone = '$phone' and weight_day='$days'";
		  $results = mysqli_query($conn,$sqls);
		  $nums=mysqli_num_rows($results);
		 
		
		 
		  if ($nums!=0)
		  {
				
				$rows = mysqli_fetch_assoc($results);
			    if ($rows['weight_record']!=0)
					$zero=0;
				  if ($first == 1)
				  {
					  $first=0;
				  echo "{\"Time\": \"".$d."\", \"Volume\": ".$rows['weight_record']."}";
			  }
			  else
			  {
				  echo ",{\"Time\": \"".$d."\", \"Volume\": ".$rows['weight_record']."}";
			  }
		  }
		  else
		  {
				  if ($first == 1)
				  {
					  $first=0;
				  echo "{\"Time\": \"".$d."\", \"Volume\": 0}";
			  }
			  else
			  {
				  echo ",{\"Time\": \"".$d."\", \"Volume\": 0}";
			  }
		  }
		  }
	  }
	  
  //        
  ?>
];
var ctx = document.getElementById('myChart').getContext('2d');

var chart = new Chart(ctx, {
  type: 'line',
  
 
  
  data: {
	labels: data.map(x=>x.Time),
	
	datasets: [{
	  label: '體重(kg)',
	  data: data.map(x=>x.Volume),
	 
	  // Line
	  lineTension: 0,
	  backgroundColor: '#FF5376',
	  borderColor: '#FF5376',
	  fill: false,
	  borderWidth: 1,
	  // Point
	  pointRadius: 5,
	  pointHoverRadius: 7,
	}]
  },
  options:{
	scales: {
	  xAxes: [{
		display: true,
		scaleLabel: {
		  display: true,
		  fontSize: 22,
		 
		  fontFamily: 'serif,sans-serif,cursive,fantasy,monospace',
		  labelString: '日期(天)'
		}
	  }],
	  yAxes: [{
		display: true,
		scaleLabel: {
		  display: true,
		  fontSize: 22,
		  fontFamily: 'serif,sans-serif,cursive,fantasy,monospace',
		 
		  labelString: '體重(kg)'
		}
	  }]
	},
	title:{
	  display: true,
	  text: '<?php echo $year."年".$month."月"?>曲線圖',
	 
	  position: 'top',
	  fontSize: 28,
	  fontStyle: 'normal',
	  fontFamily: 'serif,sans-serif,cursive,fantasy,monospace'
	},     
	legend:{
	  display: true
	},
	responsive: false
  }
});
</script>	

		  </div>

  </div>
  <div id="footer">
                    <div>
                        <span>110年專題組</span>
<?php
	  if ($zero == 1){
          echo "<script>alert('請至少在本月輸入一天體重');history.back();</script>";
		  //echo "<meta http-equiv=\"refresh\" content=\"0;url=weightrecord.php\">";
      }
?>
                    </div>
                </div>
                <!-- Optional JavaScript; choose one of the two! -->

                <!-- Option 1: Bootstrap Bundle with Popper -->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>

                <!-- Option 2: Separate Popper and Bootstrap JS -->
                <!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous"></script>
-->
            </body>

            </html>
</body>
</html>