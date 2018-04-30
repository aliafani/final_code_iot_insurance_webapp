<?php
$steps=$_POST['steps'];
$id=$_POST['id'];
$average_heartrate=$_POST['heart'];
$calories=$_POST['calories'];
$cholestrol= $_POST['cholestrol'];
$servername="localhost";
$username="root";
$password="root@123";
$dbname="insurance";
$t=time();
$date=date("h:i:sa");
$date1=date("Y-m-d") ;
$total_steps_day=$steps;


$link = mysqli_connect($servername, $username, $password, $dbname); 
if (!$link) { 
	die('Could not connect to MySQL: ' . mysql_error()); 
} 

$sql="select user_name,email,age from user_signup where id='$id'";
$result=$link->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        
        $name=$row["user_name"];
        $age= $row["age"];
        $email= $row["email"];
        //echo " - Name: " . $row["user_name"]. " " . $row["email"]. " Age ".$row["age"]. "<br>";
    }
} else {
    echo "0 results";
}


 //$sql = "INSERT INTO user_daily_records (user_id,heart_rate,steps_day,time_stamp,date,cholestrol,calories_burnt)
//VALUES($id,$average_heartrate,$steps,'$date','$date1',$cholestrol,$calories)";
//if (mysqli_query($link, $sql)) {
 // echo "New record created successfully";
//} else {
  //echo "Error: " . $sql . "<br>" . mysqli_error($link);
//}
$sql="Select  count(steps_day) as total_count, steps_day from user_daily_records where user_id='$id'";

$result=$link->query($sql);
if ($result->num_rows > 0) {
   
    // output data of each row
    while($row = $result->fetch_assoc()) {
        
        
        $total_steps_day=$total_steps_day+$row["steps_day"];
         $count=$row["total_count"];
         // echo "total steps+++++++".$steps_day;
        //echo " - Name: " . $row["user_name"]. " " . $row["email"]. " Age ".$row["age"]. "<br>";
    }
} else {
    echo "0 results";
}
 $count = $count+1;
 $average= $total_steps_day/$count;
 $health_factor=0;
 if($age>18 && $age<25){
     if($average>=1000){
     $healthfactor=5;
     }elseif($average<=7000) {
     $healthfactor=3;
     }else { 
     $healthfactor=2;
            }
 }elseif($age>26 && $age<40){
    if($average>=1000){
     $healthfactor=5;
     }elseif($average>=5000 && $average<=7000) {
     $healthfactor=3;
     }else { 
     $healthfactor=2;
            }
 
 }elseif($age>41 && $age<80){
  if($average>=8000){
     $healthfactor=5;
     }elseif($average>=4000 && $average<=7000) {
     $healthfactor=3;
     }else { 
     $healthfactor=2;
            }
 }
 
 //echo "health factor " . " ". $healthfactor;
$sql = "INSERT INTO user_daily_records (user_id,heart_rate,steps_day,time_stamp,date,cholestrol,calories_burnt,user_health_factor)
VALUES($id,$average_heartrate,$steps,'$date','$date1',$cholestrol,$calories,$healthfactor)";
if (mysqli_query($link, $sql)) {
 echo "New record created successfully";
} else {
echo "Error: " . $sql . "<br>" . mysqli_error($link);
}



?>