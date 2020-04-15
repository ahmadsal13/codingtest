<?php
  require "header.php";
?>

    <main>
      <div class="wrapper-main">
        <section class="section-default">
          <!--
          It can choose whether or not to show ANY content on our pages depending on if they are logged in or not.
          -->
          <?php
          if (!isset($_SESSION['id'])) {
            echo '<p class="login-status">You are logged out!</p>';
          } else if (isset($_SESSION['id'])) {
            echo '<p class="login-status">You are logged in!</p>';
          }
          ?>
        </section>
      </div>
    </main>

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
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700" rel="stylesheet">
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
</head>

<body class="mainloginbody">
   
    <!---------------------Opening div dont touch Julian------------------->
<div class="boxborder3">
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

<?php
  require "footer.php";
?>
</body>
</html>
