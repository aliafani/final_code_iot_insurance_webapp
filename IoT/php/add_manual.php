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
 echo $average= $total_steps_day/$count;
 $health_factor=0;
 if($age>=18 && $age<=25){
     
     if($average>=10000){
     
     $healthfactor=5;
     }elseif($average<=7000) {
    
     $healthfactor=3;
     }else { 
     $healthfactor=2;
         
            }
 }elseif($age>=26 && $age<=40){
   
    if($average>=10000){
     $healthfactor=5;
     }elseif($average>=5000 && $average<=7000) {
     $healthfactor=3;
     }else { 
     $healthfactor=2;
            }
 
 }elseif($age>=41 && $age<=80){

  if($average>=8000){
     $healthfactor=5;
     }elseif($average>=4000 && $average<=7000) {
     $healthfactor=3;
     }else { 
     $healthfactor=2;
            }
 }
 
 echo "health factor " . " ". $healthfactor;
 //die;
$sql = "INSERT INTO user_daily_records (user_id,heart_rate,steps_day,time_stamp,date,cholestrol,calories_burnt,user_health_factor)
VALUES($id,$average_heartrate,$steps,'$date','$date1',$cholestrol,$calories,$healthfactor)";
if (mysqli_query($link, $sql)) {
 echo "New record created successfully";
} else {
echo "Error: " . $sql . "<br>" . mysqli_error($link);
}


//Changes started 
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
 $average_hf=floor($total_hf/$count);
  if($old_hf<$average_hf){
  $final_savings=$average_hf-$old_hf;
  $final_savings=$final_savings*80;
  if($final_savings>100){
  $final_savings=20;
  }
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


?>