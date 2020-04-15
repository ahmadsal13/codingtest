<?php
  require "header.php";
?>

    <main>
      <div class="wrapper-main">
        <section class="section-default">
          <?php
          if (!isset($_SESSION['id'])) {
            echo '<p class="login-status">You are logged out!</p>';
          }
          else if (isset($_SESSION['id'])) {
            echo '<p class="login-status">You are logged in!</p>';
          }
          ?>
        </section>
      </div>
    </main>

<?php
  require "footer.php";
?>

<?php
 
$limit = 1000;
$y = 5;
$dataPoints = array();
for($i = 0; $i < $limit; $i++){
	$y += rand(0, 10) - 5; 
	array_push($dataPoints, array("x" => $i, "y" => $y));
	// This is the stock chart for our car sales
}
 
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="main.js"></script>    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Team Dev 3.0 project!</title>
    <link rel="stylesheet" type="text/css" href="/css/main.css">
    <link rel="shortcut icon" href="/css/pageicon.jpg" type="vortexlogo/icon" />
<script>
window.onload = function () {
	
var data = [{
		type: "line",                
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}];
	
//Better to construct options first and then pass it as a parameter
var options = {
	zoomEnabled: true,
	animationEnabled: true,
	axisY: {
		includeZero: false,
		lineThickness: 1
	},
	data: data  // random data
};
 
var chart = new CanvasJS.Chart("chartContainer", options);
var startTime = new Date();
chart.render();
var endTime = new Date();
document.getElementById("timeToRender").innerHTML = "Time to Render: " + (endTime - startTime) + "ms";
 
}
</script>
<style>
	#timeToRender {
		position:absolute; 
		top: 10px; 
		font-size: 20px; 
		font-weight: bold; 
		background-color: #d85757;
		padding: 0px 4px;
		color: #ffffff;
	}
</style>
</head>
<body class="mainlogin">
   
    <!---------------------Opening div dont touch Julian------------------->
<div class="boxborder3">
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
  <!---------------------FOOTER------------------->
   <div class="footer">
  <div class="contain">
  <div class="col">
    <h1 class="footertitle">Contact</h1>
    <ul class="columninfo">
      <li class="columnrows">About</li>
      <li class="columnrows">ahmad.salem@students.jmcss.org</li>
      <li class="columnrows">julian.dominquez@students.jmcss.org</li>
      <li class="columnrows">(731) 555-6666</li>
    </ul>
  </div>
  
  <div class="clearfix"></div>
 
</body>
</html>