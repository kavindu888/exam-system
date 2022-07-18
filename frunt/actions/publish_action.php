<?php

session_start();
include '../DB_Conn.php';
$examname = "";
$examDate = "";
$examDuration = "00:00:00";
$publishid = 2;

if (isset($_SESSION['examName'])) {

    $examname = $_SESSION['examName'];
}

if (isset($_SESSION['date'])) {

    $examDate = $_SESSION['date'];
}

if (isset($_SESSION['duration'])) {

    $examDuration = $_SESSION['duration'];
}

if ($examname === "" || $examDate === "" || $examDuration === "00:00:00") {


    header("Location:../create_exam.php?msg=Enter Exam Data !!!");
    die();
}
$currentDate = date("Y/m/d");

$userId = $_COOKIE["userId"];

$examCreateQue = "INSERT INTO `exam_management_system`.`exam`
(`name`,
`date_time`,
`duration`,
`last_updated`,
`user_id`,
`publish_id`)
VALUES
('" . $examname . "',
'" . $examDate . "',
'" . $examDuration . "',
'" . $currentDate . "',
'" . $userId . "',
'" . $publishid . "');
";
$result = $connection->query($examCreateQue);
$examId = 0;
if ($result === TRUE) {
    $examId = $connection->insert_id;

    echo $examId;
} else {
    echo '<h2>Error ! ' . mysqli_error($connection) . "</h2>";
}





if (!empty($_SESSION['quctionArray'])) {

    foreach ($_SESSION['quctionArray'] as $key => $qunction) {

        $questionNo = $qunction['quctionNo'];
        $question = $qunction['question'];

        $questionEnterQue = "INSERT INTO `exam_management_system`.`quection`
(`quection_no`,
`quection`,
`exam_id`)
VALUES (
'" . $questionNo . "',
'" . $question . "',
'" . $examId . "'
)";
        $resultq = $connection->query($questionEnterQue);
        $questionId = 0;
        if ($resultq === TRUE) {
            $questionId = $connection->insert_id;
        } else {
            echo '<h2>Error ! ' . mysqli_error($connection) . "</h2>";
        }






      

        for ($x = 1; $x <= 4; $x++) {
            $answer = "";
            switch ($x) {
                case 1:
                    $answer = $qunction['answer1'];
                    break;
                case 2:
                    $answer = $qunction['answer2'];
                    break;
                case 3:
                    $answer = $qunction['answer3'];
                    break;

                case 4:
                    $answer = $qunction['answer4'];
                    break;
            }






            $answer1Que = "INSERT INTO `exam_management_system`.`answer`
(`answer_No`,
`answer`,
`quection_id`)
VALUES
('" . $x . "',
'" . $answer ."',
'" . $questionId . "')
";
            $resultA1 = $connection->query($answer1Que);
            if ($resultA1 === TRUE) {
                
            } else {
                echo '<h2>Error ! ' . mysqli_error($connection) . "</h2>";
            }
        }
        
        
        
        
          $currectAnswer = $qunction['answer'];
          echo 'current answer'.$currectAnswer;
   $getcurrectAnswerIdQue="SELECT * FROM `exam_management_system`.`answer` WHERE  answer_No='".$currectAnswer."' AND quection_id='".$questionId."' ";     
        $resultCurrectAnswer = $connection->query($getcurrectAnswerIdQue);



$currectAnswerId=0;
if (mysqli_num_rows($resultCurrectAnswer) > 0) {

    while ($curectAnswer= mysqli_fetch_assoc($resultCurrectAnswer)) {

            $currectAnswerId= $curectAnswer['answerId'];
            echo 'correct Answer id is :'.$currectAnswerId;
            
            
               $correctAnswerque = "INSERT INTO `exam_management_system`.`currect_answer`
(`answer_id`,
`quection_id`)
VALUES (
'" . $currectAnswerId . "',
'" . $questionId . "'
)";
        $resultCorrectAnswer = $connection->query($correctAnswerque);
        echo "correcd Answer Saved";
            
    }
    
    
} else{
        echo '<h2>Error ! ' . mysqli_error($connection) . "</h2>";
    
}
    }
   unset($_SESSION['quctionArray']);
      header("Location:../teacher_open_view.php?");
    
}
