<?php
 session_start();
$id= $_SESSION["user_id"];
$name=$_SESSION["name"];
?>
<html>
<head>
 <link rel="stylesheet" href="styles/styles.css" type="text/css">
 <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
 <script src="http://localhost/IoT/scripts/jquery.min.js"></script>
 <script src="http://localhost/IoT/scripts/savings.js"></script>
 <script src="http://localhost/IoT/scripts/Chart.min.js"></script>
 <script scr="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
<title>
Admin Panel
</title>
</head>
  <body>
 <div id="header">
 <div class="logo">
 <a href="#">Go<span>Health</span></a>
 </div>
  </div>
 <div id="container">
 <div class="sidebar">
  <ul id="nav">
  <li><a  href="http://localhost/IoT/admin.php">Dashboard</a></li>
  <li><a class="selected" href="http://localhost/IoT/savings.php">Savings $$</a></li>
  <li><a  href="#">Goals</a></li>
  <li><a  href="http://localhost/IoT/add_manual_health.php">Add Health Record</a></li>
  <li><a href="http://localhost/IoT/php/logout.php">Logout</a></li>
  </ul>
 
 </div>
 <div class="content">
 
      <div class ="chart-container4" style="position: relative; height:30vh; width:30vw ; margin-top:0px;">
      <canvas id="line-chartcanvas4">
      </canvas>
      </div>
     
      
  
  
  
  <input type="text" id="user_id" value=<?php echo $id ?>  style="display: none;">


 </div>
 </div>
 </body>
 </html>