<?php
session_start();
include '../DB_Conn.php';
$userId=$_COOKIE['userId'];
$examSearchName;
if (isset($_POST['search'])) {
    $examSearchName = $_POST['search'];
}

if($examSearchName===""){
      header("Location:../teacher_open_view.php?msg=No serch text include !!!");
      die();
    
}

$_SESSION['from']=false;
  header("Location:../teacher_open_view.php?");
  die();