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
$sql="select user_name,email from user_signup where id='$id'";
$result=$link->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        
        $name=$row["user_name"];
       // $age= $row["age"];
        $email= $row["email"];
       }
} else {
    echo "0 results";
}
$sql="Select count(user_health_factor) as total_count, sum(user_health_factor) as total_sum from user_daily_records where user_id='$id'";

$result=$link->query($sql);
if ($result->num_rows > 0) {
   
    // output data of each row
    while($row = $result->fetch_assoc()) {
        
        
        $total_hf=$row["total_sum"];
         $count=$row["total_count"];
         
    }
} else {
    echo "0 results";
}
$sql="Select policy_id,health_factor,current_premium from user_policy where user_id='$id'";

$result=$link->query($sql);
if ($result->num_rows > 0) {
   
    // output data of each row
    while($row = $result->fetch_assoc()) {
        
        
        $old_hf=$row["health_factor"];
        $policy_id=$row['policy_id'];
        $current_premium=$row['current_premium'];
        
    }
} else {
    echo "0 results";
}

 //echo "NAME: ".$name;
 //echo "<br>";
 //echo "Email: ".$email;
// echo "<br>";
 //echo "total health factor ".$total_hf;
 //echo "<br>";
 //echo "Count". $count;
 
 $average_hf=floor($total_hf/$count);
 //echo "<br>";
 //echo "Average ".$average_hf;
 //echo "<br>";
// echo "old factor " . $old_hf;
 //echo "<br>";
 //echo "Current Premium".$current_premium;
  
  if($old_hf<$average_hf){
  $final_savings=$average_hf-$old_hf;
  $final_savings=$final_savings*80;
  $sql="INSERT INTO user_savings (user_id,savings,date)
        VALUES ($id,$final_savings,'$date1')";
        if ($link->query($sql) === TRUE) {
   // echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $link->error;
}
  $msg=$msg="Dear Customer, Congrats you have improved your overall health factor, and we would like to inform you that we are offering you a cheque of  $".$final_savings
  ." "."<br>Stay Healthy and Stay Wealthy..:) ";
  $msg = wordwrap($msg,70);
  mail($email,"You Did IT",$msg);
  $sql = "UPDATE user_policy SET health_factor='$average_hf' WHERE user_id='$id'";

if ($link->query($sql) === TRUE) {
    //echo "Record updated successfully";
} else {
    echo "Error updating record: " . $link->error;
}
  
  
  }elseif($old_hf>$average_hf){
   //$final_increament=$old_hf-$average_hf;
   //$final_increament=$final_increament*10;
      $final_savings=0;
      $sql="INSERT INTO user_savings (user_id,savings,date)
        VALUES ($id,$final_savings,'$date1')";
 if ($link->query($sql) === TRUE) {
    //echo "New record created successfully";
} else {
    //echo "Error: " . $sql . "<br>" . $link->error;
}       
  $msg="Dear Customer, We are sorry to inform you that your overall health factor has gone off the rails. We hope you will work again to get back on track ";
  $msg = wordwrap($msg,70);
  mail($email,"Urgent Health factor",$msg);
  $sql = "UPDATE user_policy SET health_factor='$average_hf' WHERE user_id='$id'";
  if ($link->query($sql) === TRUE) {
   // echo "Record updated successfully";
} else {
    //echo "Error updating record: " . $link->error;
}
   }elseif($old_hf==$average_hf){
      if($old_hf<=3){
     $msg="Dear Customer, We are sorry to inform you that your overall health factor has gone off the rails. We hope you will work again to get back on track ";
  $msg = wordwrap($msg,70);
  mail($email,"Urgent Health factor",$msg);
  
      }elseif($old_hf>=4){
        $final_savings=40;
        $sql="INSERT INTO user_savings (user_id,savings,date)
        VALUES ($id,$final_savings,'$date1')";
 if ($link->query($sql) === TRUE) {
    //echo "New record created successfully";
} else {
    //echo "Error: " . $sql . "<br>" . $link->error;
}      
  $msg="Dear Customer, Congrats you have improved your overall health factor, and we would like to inform you that we are offering you a cheque of  $".$final_savings
  ." "."<br>Stay Healthy and Stay Wealthy..:) ";
  $msg = wordwrap($msg,70);
  mail($email,"You Did IT",$msg);
      
      
      }
   
   
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