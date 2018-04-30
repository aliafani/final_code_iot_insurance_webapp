<?php
header('Content-Type:application/json');
$id=$_POST["user_id"];
$servername="localhost";
$username="root";
$password="root@123";
$dbname="insurance";
$date1=date("Y-m-d");
$link = mysqli_connect($servername, $username, $password, $dbname); 
if (!$link) { 
	die('Could not connect to MySQL: ' . mysql_error()); 
}
$sql="Select savings,date from user_savings where user_id='$id'";
$result=$link->query($sql);
if ($result->num_rows > 0) {
  foreach($result as $row){
  $data[]=$row;
}

}else{

}
print json_encode($data);




?>