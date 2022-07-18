<?php

session_start();
include '../DB_Conn.php';
$examName = "";
$date = "";
$time = "";
$duration = "";


if (isset($_POST['create_exam'])) {
    $examName = $_POST['create_exam'];
}

if (isset($_POST['date'])) {

    $date = $_POST['date'];
}

if (isset($_POST['duration'])) {
    $duration = $_POST['duration'];
    echo $duration;
}
if ($examName === "") {
    header("Location:../create_exam.php?msg=Enter Exam Name !!!");
    die();
} else if ($date === "") {
    header("Location:../create_exam.php?msg=Enter Exam Date and Time !!!");
    die();
} else if ($duration === "00:00:00") {
    header("Location:../create_exam.php?msg=Enter Exam Duration !!!");
    die();
}

$publishid = 1;

$cur3rentDate = date("Y/m/d");

$userId = $_COOKIE["userId"];

$que = "INSERT INTO `exam_management_system`.`exam`
(`name`,
`date_time`,
`duration`,
`last_updated`,
`user_id`,
`publish_id`)
VALUES
('" . $examName . "',
'" . $date . "',
'" . $duration . "',
'" . $currentDate . "',
'" . $userId . "',
'" . $publishid . "');
";

$result = $connection->query($que);

if ($result === TRUE) {
   $_SESSION['examId']= $connection->insert_id;
    $_SESSION['createExamForm']="disabled";
    $_SESSION['examName']=$examName;
    $_SESSION['examDate']=$date;
    $_SESSION['createQuestionForm']="";
    $_SESSION['examDuration']=$duration;
 header("Location:../create_exam.php?ms= Exam Created success.Enter Questions");
}else{
     echo '<h2>Error ! '.$connection->error."</h2>";
}