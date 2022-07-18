<?php

session_start();
include '../DB_Conn.php';
$examId = "";
if (isset($_GET['id'])) {
    $examId = $_GET['id'];
} else {
    die();
}

$userId;
if (isset($_COOKIE["userId"])) {
    $userId = $_COOKIE["userId"];
  
}

$checkAtendque = "SELECT * FROM exam_management_system.`result` WHERE exam_id='" . $examId . "' AND  user_id='" . $userId . "' ";

$attend = $connection->query($checkAtendque);
if (mysqli_num_rows($attend) > 0) {
   $_SESSION["examId"]=$examId;
    header("Location:../exam-result.php?msg=You are arly attend the exam !!!");
    die();
} else {






    $que = "SELECT * FROM exam_management_system.`exam` WHERE examId='" . $examId . "' ";

    $resultExam = $connection->query($que);
    if (mysqli_num_rows($resultExam) > 0) {
        while ($examData = mysqli_fetch_assoc($resultExam)) {

            $examName = $examData['name'];
            $examlastUpdate = $examData['last_updated'];

            $examDate = $examData['date_time'];
            $duration = $examData['duration'];

            $dateTime = new DateTime($examDate);
            $date = $dateTime->format("Y-m-d");
            $time = $dateTime->format('H:i:s');

            date_default_timezone_set("Asia/Colombo");
            $currentDate = date("Y-m-d");

            if ($currentDate === $date) {

                $currentTime = date("H:i:s");

                $secs = strtotime($time) - strtotime("00:00:00");
                $examEndTime = date("H:i:s", strtotime($duration) + $secs);

                print_r($examEndTime);
                echo ' ';
                print_r($currentTime);

                if ($currentTime > $time && $currentTime < $examEndTime) {

                    $_SESSION['examId'] = $examId;
                    $_SESSION['examName'] = $examName;
                    $_SESSION['examEndTime'] = $examEndTime;

                    header("Location:../single_exam.php");
                    die();
                } else {
                    header("Location:../student_open_view.php?msg= Check Your Exam Time !!!");
                    die();
                }
            } else {
                header("Location:../student_open_view.php?msg=This exam Not Shedule Today !!!");
                die();
            }
        }
    }
}