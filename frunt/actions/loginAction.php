<?php
session_start();
include '../DB_Conn.php';
$email;
$pw;
if (isset($_POST['email'])) {
    $email = $_POST['email'];
}

if (isset($_POST['pw'])){
    $pw=$_POST['pw'];
    
}
if ($email=="" || $pw=="" ) {
    header("Location:../login.php?msg=plese fill all data !!!");
    die();
}

$que="SELECT * FROM exam_management_system.`user` INNER JOIN exam_management_system.`role` ON exam_management_system.`user`.`role_id`=exam_management_system.`role`.`roleId` WHERE `email`='".$email."' AND `password`= '".$pw."' ";
$resultUserEmail = $connection->query($que);
if (mysqli_num_rows($resultUserEmail) > 0) {
     while ($userData = mysqli_fetch_assoc($resultUserEmail)) {
   $role=$userData['role'];
   $userId=$userData['userID'];
   
   
       $cookie_name = "userId";
$cookie_value = $userId ;
setcookie($cookie_name, $cookie_value, time() + (86400 * 30*12), "/");
    
   
   if($role==="student"){
         header("Location:../student_open_view.php?");
         $_SESSION['from']=true;

         die();
   }else{
       
        header("Location:../teacher_open_view.php?"); 
        
       
            die();
   }
     }
    
}else{
    
     header("Location:../login.php?msg=Check your email and password!!!");
    die();
}

