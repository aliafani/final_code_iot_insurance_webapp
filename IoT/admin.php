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
 <script src="http://localhost/IoT/scripts/dashboard.js"></script>
 <script src="http://localhost/IoT/scripts/Chart.min.js"></script>
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
  <li><a class="selected" href="#">Dashboard</a></li>
   <li><a href="http://localhost/IoT/savings.php">Savings $$</a></li>
  <li><a href="#">Goals</a></li>
  <li><a href="http://localhost/IoT/add_manual_health.php">Add Health Record</a></li>
  
  <li><a href="http://localhost/IoT/php/logout.php">Logout</a></li>

 
 </ul>
 
 </div>
 <div class="content">
 <h2> Welcome <?php echo $name ?> </h2>

      <div class ="chart-container1" style="position: relative; height:30vh; width:30vw ; margin-top:0px;">
      <canvas id="line-chartcanvas">
      </canvas>
      </div>
      <div class ="chart-container2" style="position: relative; height:30vh; width:30vw ; margin-top:-191px; margin-left:500px;">
      <canvas id="line-chartcanvas2">
      </canvas>
      </div>
       <div class ="chart-container3" style="position: relative; height:30vh; width:30vw ; margin-top:57px; margin-left:200px;">
      <canvas id="line-chartcanvas3">
      </canvas>
      </div>
      
  
  
  
  <input type="text" id="user_id" value=<?php echo $id ?>  style="display: none;">


 </div>
 </div>
 </body>
 </html>