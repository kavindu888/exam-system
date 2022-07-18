<?php
session_start();
include '../DB_Conn.php';

$examIdp;
$userId;
$examId;
if (isset($_SESSION["examId"])) {
  $examId=  $_SESSION["examId"];
 
}
$userId;
if (isset($_COOKIE["userId"])) {
    $userId = $_COOKIE["userId"];
  
}

if (!empty($_SESSION['answerArray'])) {

    $allque = "SELECT * FROM exam_management_system.`quection` WHERE exam_id='" . $examId . "'";

$resultque = $connection->query($allque);

if (mysqli_num_rows($resultque) > 0) {
    $questioncount = mysqli_num_rows($resultque);

   
   echo "question couynt : ". $questioncount;
    $answerPresantage;
    $gradeId;
    $correctResultCount=0;
      foreach ($_SESSION['answerArray'] as $key => $answer) {

        $questionId = $answer['questionId'];
        $answerId = $answer['answerId'];
        
         $checkQue = "SELECT * FROM exam_management_system.`currect_answer` WHERE `quection_id`='" . $questionId . "' AND `answer_id`='".$answerId."'";

$result = $connection->query($checkQue);

if (mysqli_num_rows($result) > 0) {
    
     $correctResultCount++;
   echo "result : ". $correctResultCount;
    
}
   $answerPresantage=$correctResultCount/$questioncount*100;
        echo "result prasantage : ". $answerPresantage;
        $gradeque="";
        if($answerPresantage>=75){
             $gradeque = "SELECT * FROM exam_management_system.`grade` WHERE `grade`='A'";
        }else if($answerPresantage>=65){
              $gradeque = "SELECT * FROM exam_management_system.`grade` WHERE `grade`='B'";
        }else if($answerPresantage>=45){
              $gradeque = "SELECT * FROM exam_management_system.`grade` WHERE `grade`='C'";
        }else if($answerPresantage>=35){
          $gradeque = "SELECT * FROM exam_management_system.`grade` WHERE `grade`='S'";
        }else{
            
              $gradeque = "SELECT * FROM exam_management_system.`grade` WHERE `grade`='F'";
        }
        $resultgrade = $connection->query($gradeque);

if (mysqli_num_rows($resultgrade) > 0) {
        while ($gradeData = mysqli_fetch_assoc($resultgrade)) {
            
            $gradeId=$gradeData["gradeId"];
            echo "graqde3 id is :". $gradeId;
            
  
        }
}
    }
              $result = "INSERT INTO `exam_management_system`.`result`
(`user_id`,
`exam_id`,
`marks`,
`grade_id`)
VALUES
('" . $userId . "',
'" . $examId . "',
'" . $answerPresantage. "',
'" . $gradeId . "')
";
$result = $connection->query($result);
$resultId = 0;
if ($result === TRUE) {
    $resultId = $connection->insert_id;

    echo $resultId;
} else {
    echo '<h2>Error ! ' . mysqli_error($connection) . "</h2>";
}
}
}

if (!empty($_SESSION['answerArray'])) {
    
         foreach ($_SESSION['answerArray'] as $key => $answer) {

        $questionId = $answer['questionId'];
        $answerId = $answer['answerId'];
        
         $checkQue = "SELECT * FROM exam_management_system.`currect_answer` WHERE `quection_id`='" . $questionId . "'";

$result = $connection->query($checkQue);
    $isWrite=0;
if (mysqli_num_rows($result) > 0) {
      while ($resultData = mysqli_fetch_assoc($result)) {
        
            $correctAnswerId=$resultData["answer_id"];
            if($correctAnswerId===$answerId){
                $isWrite=1;
            }else{
               $isWrite=0; 
            }
    
}
         }
         
                       $studentAnswerQue = "INSERT INTO `exam_management_system`.`student_answer`
(`result_id`,
`quection_id`,
`answer_id`,
`if_answer_right`)
VALUES
('" . $resultId . "',
'" . $questionId . "',
'" . $answerId. "',
'" . $isWrite . "')
";
$getResultQue = $connection->query($studentAnswerQue);

if ($getResultQue === TRUE) {
  
} else {
    echo '<h2>Error ! ' . mysqli_error($connection) . "</h2>";
}
         
         
    
}
   unset($_SESSION['answerArray']);
     header("Location:../exam-result.php");
}