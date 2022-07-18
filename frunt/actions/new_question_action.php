<?php
session_start();
include '../DB_Conn.php';


 $examId=  $_SESSION['examId'];
 echo $examId;
 
 
