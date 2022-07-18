<?php


$username = "root";
$password = "42141974";
$databaseName ="exam_management_system";
$HostUrl = "localhost";
$Hostport ="3307";

$connection =new mysqli($HostUrl, $username, $password, $databaseName,  $Hostport );

if($connection->connect_error){
    echo 'Error !, Not Connected.' .$connection->connect_error;
}else{
  // echo "connected Successfully";
}
