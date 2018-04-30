<?php
header('Content-Type:application/json');
$id=$_POST['user_id'];
$servername="localhost";
$username="root";
$password="root@123";
$dbname="insurance";
$date1=date("Y-m-d");
//$total_hf=0;
$link = mysqli_connect($servername, $username, $password, $dbname); 
if (!$link) { 
	die('Could not connect to MySQL: ' . mysql_error()); 
} 

$sql="Select heart_rate,steps_day,date,time_stamp,user_health_factor from user_daily_records where user_id='$id'";

$result=$link->query($sql);
if ($result->num_rows > 0) {
   
  foreach($result as $row){
  $data[]=$row;
}
       
print json_encode($data);
         // echo "total steps+++++++".$steps_day;
        //echo " - Name: " . $row["user_name"]. " " . $row["email"]. " Age ".$row["age"]. "<br>";
    }
 else {
    //echo "0 results";
}
      

?>