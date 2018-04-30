<?php

if(!isset($_POST)) die();

$response=[];
$con=mysqli_connect('localhost','root','root@123','insurance');
$email=$_POST['email'];
$password=$_POST['password'];
//$email='rob@yopmail.com';
//$password='1234@';
$query="Select id, user_name,email,password from user_signup  WHERE email='$email' AND password='$password'";
$result=mysqli_query($con,$query);
if(mysqli_num_rows($result) > 0){
while($row = $result->fetch_assoc()) {
        
        
         $id=$row["id"];
         $name=$row["user_name"];
        session_start();
        $_SESSION["user_id"]=$id;
        $_SESSION["name"]=$name;
          
         // echo "total steps+++++++".$steps_day;
        //echo " - Name: " . $row["user_name"]. " " . $row["email"]. " Age ".$row["age"]. "<br>";
    }
header("Location: http://localhost/IoT/admin.php");
}else{
echo "Sorry Wrong Password,Please try again";

}
//echo json_encode($response);

?>