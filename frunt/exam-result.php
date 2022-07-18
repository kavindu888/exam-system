<?php 
session_start();
include './DB_Conn.php';
 $examId;
if (isset($_SESSION["examId"])) {
  $examId=  $_SESSION["examId"];
 
}
$userId;
if (isset($_COOKIE["userId"])) {
    $userId = $_COOKIE["userId"];
  
}
$marks;
$grade;
  
       $getResultque="SELECT * FROM exam_management_system.`result` INNER JOIN exam_management_system.`grade` ON exam_management_system.`result`.`grade_id`=exam_management_system.`grade`.`gradeId` WHERE `exam_id`='".$examId."' AND `user_id`= '".$userId."' ";

$resultget = $connection->query($getResultque);
if (mysqli_num_rows($resultget) > 0) {
     while ($resultData = mysqli_fetch_assoc($resultget)) {
   $marks=$resultData['marks'];
   $grade=$resultData['grade'];
   $resultId=$resultData['result_id'];
     }
}
?>




<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Result</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=League+Gothic&display=swap" rel="stylesheet">

    </head>
    <body>
        <br>
        <a href="student_open_view.php" style="color: #000000;text-decoration: none;" >   <span ><image src="icon/back.png"/>Back</span></a>

        <br>
        <br>


        <div class="container">

            <div class="row  justify-content-center">
                <div class="col-12 col-sm-12 col-md-8 col-lg-6 ">

                    <div class="  justify-content-center" >


                        <div style="border-style: solid;border-color: #99ccff;padding: 25px 25px 25px 25px;border-width: 1px;border-radius: 5px;">
                            <span class="fw-bold">Exam Completed</span>
                            <div class="text-center">
                                <span class="fw-bold" style="color: #00cc33;font-size: 50px;"><?php echo $grade;?></span>
                                <br>
                                <span class="fw-semibold fs-5"><?php echo"Presantage : ". $marks."%"?> </span> 

                            </div>
                        </div>
                        <br>
                        <div style="border-style: solid;border-color: #99ccff;padding: 25px 25px 25px 25px;border-width: 1px;border-radius: 5px;">
                            <span class="fw-bold">Questions</span>
                            
                            <?php
                            
                            
  

                         $lordAnswersque="SELECT * FROM exam_management_system.`student_answer` INNER JOIN exam_management_system.`quection` ON exam_management_system.`student_answer`.`quection_id`=exam_management_system.`quection`.`quction_id` WHERE `result_id`='".$resultId."' ORDER BY quection_no ASC ";
    $answersque = $connection->query($lordAnswersque);
if (mysqli_num_rows($answersque) > 0) {
     while ($resultData = mysqli_fetch_assoc($answersque)) {
   $questionNo=$resultData['quection_no'];
   $question=$resultData['quection'];
   $isCorrect=$resultData['if_answer_right'];
  

                            ?>
                            
                            
                            <div class="" style="border-style: solid;border-color: #cccccc;padding: 10px 10px 10px 10px;border-width: 1px;border-radius: 5px;">
                                <div class="row" >
                                    <div class="col-auto me-auto">
                                        <span><?php echo 'Question '.$questionNo;?></span>
                                    </div>
                                    <div class="col-auto">
                                        <?php
                                        $correct;
                                        if($isCorrect>0){
                                           $correct="Correct";
                                           $color= "#00cc33";
                                        }else{
                                            $correct="Incorrect";
                                           $color= "#ff0000"; 
                                            
                                            
                                        }
                                        
                                        ?>
                                        <span class="fw-bold" style="color:<?php echo $color;?>"><?php echo $correct;?></span>
                                    </div>
                                </div>
                               
                            </div>
                              <br>
                            <?php 
                                 }
} 
                            ?>
                          
                           
                        </div>
                        <br>

                        <div class="container">
                            <div class="row  ">
                                <div class="col-auto me-auto">
                                    
                                    <a  href="student_open_view.php" style="text-decoration: none;color: #ffffff;"> <button class="btn btn-secondary btn-sm" style="width: 100px;">Close</button></a>
                                </div>

                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <br>
            <br>
            <div class="row ">

            </div>
        </div>
    </body>
</html>
