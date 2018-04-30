<?php
session_start();
$id= $_SESSION["user_id"];

?>


<html>
<head>
 <link rel="stylesheet" href="styles/styles.css" type="text/css">
 <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
 <script src="http://localhost/IoT/scripts/jquery.min.js"></script>

 <script>
      $(function () {
        $('form').on('submit', function (e)  {

event.preventDefault();// using this page stop being refreshing 

          $.ajax({
            type: 'POST',
            url: 'http://localhost/Iot/php/add_manual.php',
            data: $('form').serialize(),
            success: function () {
              alert('Your health record has been saved');
            }
          });

        });
      });
    </script>


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
  <li><a href="http://localhost/Iot/admin.php">Dashboard</a></li>
  <li><a href="http://localhost/IoT/savings.php">Savings $$</a></li>
  <li><a href="#">Goals</a></li>
  <li><a class="selected" href="#">Add Health Record</a></li>
   <li><a href="http://localhost/IoT/php/logout.php">Logout</a></li>

 
 </ul>
 
 </div>
 <div class="content">
 <h2> Enter your daily health data</h2>
 
 <form action="" method="post">
<table>
<tr>
<td>
 Total steps:
  </td>
  <td>
  <input type="text" name="steps" size="10">
  </td>
  </tr>
  <input type="text" name="id" value=<?php echo $id?> style="display:none;" >
    <tr>
    <td>
    Total Cholestrol:
  </td>
  <td height="50">
  <input type="text" name="cholestrol" size="10">
  </td>
  </tr>
  <tr>
  <td>
  Average heart Rate
  </td>
  <td>
   <input type="text" name="heart" size="10">
   </td>
  </tr>
  <td >
  Calories burnt (Kcal):
  </td>
  <td>
   <input type="text" name="calories" size="10">
   </td>
  </tr>
  <tr>
  <td height="100">
 <input name="submit" type="submit" value="Submit">
</tr>
</td>
</form>

 </div>
 </div>
 </body>
 </html>